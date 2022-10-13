<div class="row chat-wrapper" style="height: 100%">
    <div class="col-lg-12 chat-content">
        <div class="chat-header border-bottom pb-2">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                        <p>{{ $ticket->title }}</p>
                        <p class="text-muted tx-13">{{ $ticket->site->name }}</p>
                        <p>{{ $ticket->status->getLabel() }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center me-n1">
                    {{__('created')}}: {{$ticket->created_at}}<br>
                    {{__('updated')}}: {{$ticket->updated_at}}<br>
                    {{__('closed')}}: {{$ticket->closed_at}}
                </div>
            </div>
        </div>
        <div class="chat-body" style="max-height: 100%">
            <ul class="messages">
                <li class="message-item friend">
                    <i class="fas fa-user img-xs rounded-circle"></i>
                    <div class="content">
                        <div class="message">
                            <div class="bubble">
                                <p>{{$ticket->body}}</p>
                            </div>
                            <span>{{$ticket->created_at}}</span>
                        </div>
                    </div>
                </li>
                @foreach($ticket->answers as $ticketAnswer)
                    <li class="message-item @if ($ticketAnswer->user ?? null) friend @else me @endif">
                        @if ($ticketAnswer->user ?? null)
                            <i class="fas fa-user img-xs rounded-circle"></i>
                        @else
                            <!-- todo move style to css -->
                            <i class="fa-light fa-user-secret img-xs rounded-circle"
                               style="order: 2; margin-left: 15px;"></i>
                        @endif
                        <div class="content">
                            <div class="message">
                                <div class="bubble">
                                    <p>{{$ticketAnswer->body}}</p>
                                </div>
                                <span>{{$ticketAnswer->created_at}}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="chat-footer">
            <form wire:submit.prevent="addTicketAnswer" >
                <div class="row">
                    <div class="col-sm-2">
                        <x-forms.select model="ticket.status"
                                        :values="\App\Enum\Tickets\TicketStatusEnum::asKeyValue()"/>
                    </div>
                    <div class="col-sm-8">
                        <x-forms.textarea model="answer.body"/>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success">{{__('send')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
