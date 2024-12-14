<!-- newCount is passing from NotificationMenu component class -->

<div class="dropdown">

    <button class="dropdown bg-transparent p-1 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
        <i class="far fa-bell fa-lg position-relative"></i>
        @if($newCount)
        <!-- <span class=" badge badge-warning navbar-badge p-0">{{$newCount}}</span> -->
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{$newCount}} </span>
        @endif
    </button>

    <!-- background-color:#66c5d9 -->

    <ul class="dropdown-menu border-0" style="width:325px; position: absolute;right: 0px; ">
        <li class="nav-item dropdown me-1" style="list-style: none;">

            <span class="dropdown-header text-center">{{$newCount}} الاشعارات</span>
            <div class="dropdown-divider"></div>



            <!-- $notifications passing from NotificationMenu component class -->
            @foreach($notifications as $notification)
            <!-- use text-bold to unread motification -->
            <!-- Check the notification_id in middleware MarkNotifiactionAsRead -->

            <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="dropdown-item @if($notification->unread()) fw-bold @endif" style="padding: 8px;">
                <!-- data column in database store array inside return is inside the toDatabase function in OrderCreatedNotifiaction.php inside return -->
                <i class="{{$notification->data['icon']}} mr-2 " style="color: #009FBF; padding-left:3px;"></i>
                <span class="text-wrap text-end" style="display:inline-flex;">{{$notification->data['body']}}</span>
                <br>
                <span class=" float-right text-muted text-sm d-flex pe-3">منذ {{$notification->created_at->longAbsoluteDiffForHumans()}} </span>
            </a>

            @endforeach

        </li>
    </ul>

</div>