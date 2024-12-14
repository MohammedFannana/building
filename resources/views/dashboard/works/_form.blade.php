<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <!-- descripton -->
        <div class="mt-4">
            <x-form.textarea name="description" :value="$work->description" class="border border-dark" type="text" label=" وصف الية عمل الموقع" />
        </div>

        <!-- video -->
        <div class="mt-4">
            <x-form.input name="video" class="border border-dark" type="file" label="الفيديو" />
            @if($button == " تعديل ")
            <video src="{{asset('storage/' . $work->video)}}" alt="" width="100px" controls autoplay> </video>
            @endif
        </div>



        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF;padding-right: 20px; padding-left: 20px;" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>