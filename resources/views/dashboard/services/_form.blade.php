<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <div>
            <x-form.input name="name" class="border border-dark " type="text" label=" اسم الخدمة المقدمة " :value="$service->name" autocomplete="" />
        </div>

        <!-- image -->
        <div class="mt-4">
            <x-form.input name="image" class="border border-dark" type="file" label="الصورة" />
            @if($button == " تعديل ")
            <img src="{{asset('storage/' . $service->image)}}" alt="" width="80px">
            @endif
        </div>

        <!-- descripton -->
        <div class="mt-4">
            <x-form.textarea name="description" :value="$service->description" class="border border-dark" type="text" label=" الوصف" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF;padding-right: 20px; padding-left: 20px;" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>