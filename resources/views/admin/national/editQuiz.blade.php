@extends('admin.header')

@section('section')
    <div class="container-fluid">
        <form method="post" action="{{ route('n_quiz_update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div class="form-group">
                <label for="savol">Savol</label>
                <textarea name="quiz_text" class="form-control" id="savol" rows="3">{{ $quiz->quiz }}</textarea>
                @if ($quiz->photo != "no_photo")
                    <img src="{{ asset('quiz_images') }}/{{ $quiz->photo }}" alt="">
                @endif
                <div class="custom-file mt-1">
                    <input name="quiz_photo" type="file" class="custom-file-inputq" id="customFileq">
                    <label class="custom-file-label" for="customFileq">Yangi rasm</label>
                </div>
            </div>
            <hr class="text-dark bg-dark">
            <div class="form-group">
                <label for="ball">Ball</label>
                <input required name="ball" type="text" class="form-control" id="ball" placeholder="Ball..." value="{{ $quiz->ball }}">
            </div>
            <hr class="text-dark bg-dark">
            @if ($quiz->type == "close")
                <h4>Savol turi: Yopiq</h4>
            @else
                @foreach ($answers as $id => $answer)
                    <div class="form-group">
                        @if ($answer->correct == 0)
                            <label for="javob{{ $id }}">Notogri Javob</label>
                        @else
                            <label for="javob{{ $id }}">Togri Javob</label>   
                        @endif
                        <input type="hidden" name="answer_id{{ $id }}" value="{{ $answer->id }}">
                        <textarea name="answer{{ $id }}" class="form-control" id="javob{{ $id }}" rows="1">{{ $answer->answer }}</textarea>
                        @if ($answer->photo != "no_photo")
                            <img src="{{ asset('answer_images') }}/{{ $answer->photo }}" alt="">
                        @endif
                        <div class="custom-file mt-1">
                            <input name="answer_photo{{ $id }}" type="file" class="custom-file-input{{ $id }}" id="javobrasm{{ $id }}">
                            <label class="custom-file-label" for="javobrasm{{ $id }}">Yangi rasm</label>
                        </div>
                    </div>
                    <hr class="text-dark bg-dark">
                @endforeach
            @endif
            
            
            
            <input type="submit" value="Yangilash" class="btn btn-primary">
        </form>

    </div>

@endsection

@push('script')
    <script type="text/javascript">
        document.querySelector('.custom-file-inputq').addEventListener('change',function(e){
        var fileName = document.getElementById("customFileq").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        document.querySelector('.custom-file-input0').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm0").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })
        
        document.querySelector('.custom-file-input1').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm1").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        document.querySelector('.custom-file-input2').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm2").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        document.querySelector('.custom-file-input3').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm3").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        document.querySelector('.custom-file-input4').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm4").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        document.querySelector('.custom-file-input5').addEventListener('change',function(e){
        var fileName = document.getElementById("javobrasm5").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
        })

        
    </script>
@endpush

