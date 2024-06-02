<div class="content">
    <div class="profile">
        <div class="avatar" wire:click="showInFo()">
            <img src="{{asset('/images/demo.jpg')}}" alt="">
       </div>
       <div class="name"  wire:click="showInFo()">
           Alex
       </div>
       @if($showInfo === true)
       <div class="info">
          <ul>
             <li>
                <button>Profile</button>
             </li>
             <li>
                <form action="{{route('user.logout')}}" method="post">
                  @csrf
                    <button type="submit">logout</button>
               </form>
             </li>
          </ul>
       </div>
       @endif
    </div>
</div>