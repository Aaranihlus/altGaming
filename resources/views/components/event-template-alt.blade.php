<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4 animate__animated animate__fadeIn">

  <div class="content-template extra-rounded flex-y" style="border: 2px solid #ffc107; height: 400px; box-shadow: 3px 3px;
      background-image: url({{ asset('storage/' . $event->thumbnail) }});
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;">

      <div class="p-3 flex-y extra-rounded" style="justify-content: space-between; height: 100%;
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 1));">

        <div>
          <h1 class="clip-text-2" style="color: white; text-shadow: 3px 3px #1d1800;">{{ $event->name }}</h1>
          <div class="flex-x" style="align-content: center; justify-content: flex-start; align-items: flex-start;">

            @if($event->type == "altlan")
              <div class="badge bg-warning"><a href="/{{ $event->type }}">altLAN</a></div>
            @endif

            <h6 style="margin-left: 8px;">Created {{ \Carbon\Carbon::parse( $event->created_at )->diffForHumans() }}</h6>
          </div>

          <br>

          <h5>
            <span>{{ \Carbon\Carbon::parse( $event->start_date )->isoFormat('Do MMMM YYYY hh:m A') }}</span>
            @if(!empty($event->end_date))
              <span>- {{ \Carbon\Carbon::parse( $event->end_date )->isoFormat('Do MMMM YYYY hh:m A') }}</span>
            @endif
          </h5>

          <br>

          @if($event->type == "altlan")
            <h4><span class="event-registered-count">{{ count($event->attendees) }}</span> <i class="fas fa-users"></i></h4>
            <button type="button" class="btn btn-warning"><a href="/shop/tickets"><i class="fas fa-ticket-alt"></i> Get Tickets</a></button>
          @else
            <h4><span class="event-registered-count">{{ count($event->attendees) }}</span> <i class="fas fa-users"></i></h4>
            <button type="button" class="btn btn-warning event-sign-up-button" data-id="{{ $event->id }}"><i class="fas fa-user-plus"></i> Sign Up</button>
          @endif

        </div>

        <div>
          <p class="clip-text-4">{{ $event->description }}</p>
        </div>

      </div>

  </div>

</div>
