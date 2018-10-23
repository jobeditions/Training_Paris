<!-- Bannière -->
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box {{ $type.'-box' }}">
                <!-- Intitulé -->
                    <h1 class="box-title">
                        <i class="icon-{{ $icon }}"></i>
                        {{ $name }}
                    </h1>
                    @if (isset($content))
                        <hr>
                        <p>{{ $content }}</p>
                    @endif
            </div>
        </div>
    </div>
