<div class="media">
    <div class="media-left">
        <img src="{{ url('storage/avatars/'.$assignment->teacher->data->avatar) }}" class="media-object"
             style="width:60px">
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $name }}&nbsp;<small class="nota-bene">, posté le <span class="date-format">{{ $message->created_at }}</span></small></h4>
        <p>{{ $message->message }}</p>
    </div>
</div>
