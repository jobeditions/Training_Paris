<div class="white-box">



    <div id="calendar"></div>

    <script>
        window.TeacherHawk.calendar.prepared = [] ;
         @foreach ($calendar as $data)
       window.TeacherHawk.calendar.prepared.push(

           {
               url:"/student/{{ $data->type }}/{{ $data->id }}",
               title:"{{ $data->name }}",
               start:"{{ $data->due_date }}".split(" ")[0]
           }

       )
        @endforeach


    </script>

</div>
