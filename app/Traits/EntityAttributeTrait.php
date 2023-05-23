<?php

namespace App\Traits;

use App\Enum\Attributes\AttributeTypesEnum;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\EntityAttribute;
use Illuminate\Database\Eloquent\Model;

trait EntityAttributeTrait
{
    public function updateEntityAttributes(Model $entity, $values)
    {

        foreach ($values as $slug => $value) {
            $attribute = Attribute::query()->with('entitiable')->where('slug', $slug)->first();

            if ($attribute ?? null) {
                $entityAttribute = EntityAttribute::query()->where([
                    'entity_attribute_type' => get_class($entity),
                    'entity_attribute_id'   => $entity->getKey(),
                    'attribute_id'          => $attribute->id,
                ])->first();

                if ($entityAttribute ?? null) {
                    $attributeValue = AttributeValue::query()->find($entityAttribute->attribute_value_id);
                } else {
                    $attributeValue = new AttributeValue();
                    $attributeValue->attribute()->associate($attribute);
                }

                if (in_array($attribute->type, [AttributeTypesEnum::Textarea, AttributeTypesEnum::Html, AttributeTypesEnum::Text])) {
                    if ($attribute->is_translatable) {
                        $attributeValue->text_value = $value;
                    } else {
                        $attributeValue->non_translatable_value = $value;
                    }
                } elseif (in_array($attribute->type, [AttributeTypesEnum::Select])) {
                    $attributeValue->attribute_predefined_value_id = $value;
                } else {
                    if ($attribute->is_translatable) {
                        $attributeValue->value = $value;
                    } else {
                        $attributeValue->non_translatable_value = $value;
                    }
                }

                $attributeValue->save();

                if ($attributeValue->wasRecentlyCreated) {
                    $entityAttribute = new EntityAttribute();
                    $entityAttribute->attribute()->associate($attribute);
                    $entityAttribute->entitiable()->associate($entity);
                    $entityAttribute->attributeValue()->associate($attributeValue);
                    $entityAttribute->save();
                }


            }

        }
    }

    public function attributesToArray(Model $entity): array
    {

        $attributes = [];

        $entityAttributes = $entity->attributes;

        if ($entityAttributes === null) {
            return [];
        }

        foreach ($entityAttributes as $entityAttribute) {
            $value = null;
            if (!$entityAttribute->attribute->is_translatable && $entityAttribute->attribute_predefined_value_id === null) {
                $value = $entityAttribute->non_translatable_value;
            } elseif ($entityAttribute->attribute_predefined_value_id ?? null) {
                $value = $entityAttribute->attribute->predefinedValues->where('id', $entityAttribute->attribute_predefined_value_id)->first()->value;
            } elseif ($entityAttribute->attribute->is_translatable) {
                if ($entityAttribute->value ?? null) {
                    $value = $entityAttribute->value;
                }
                if ($entityAttribute->text_value ?? null) {
                    $value = $entityAttribute->text_value;
                }
            }

            $attributes[$entityAttribute->attribute->slug] = [
                'name'  => $entityAttribute->attribute->name,
                'value' => $value,
            ];
        }

        return $attributes;
    }
}
