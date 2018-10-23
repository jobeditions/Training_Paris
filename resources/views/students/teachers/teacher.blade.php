<div class="white-box">
    <!-- En-tête -->
        <div class="media">
            <div class="media-body">
                <h1 class="box-title">
                    <i class="icon-user"></i>{{ $teacher->fname }}
                        <br>
                        <small class="m-t-10">Professeur de : {{ $teacher->matter }}</small>
                </h1>
            </div>
            <div class="media-right">
                <a href="teachers/{{ $teacher->id }}"><button class="btn btn-primary">Accéder au portail de {{ $teacher->fname }}</button></a>
            </div>
    </div>
</div>
