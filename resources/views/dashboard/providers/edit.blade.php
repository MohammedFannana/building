<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">مقدمي الخدمات</li>
    <li class="breadcrumb-item active"> تعديل مقدم خدمة </li>
    @endsection

    <form action="{{route('dashboard.provider.update' , $provider->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.providers._form' , [
        'button' => ' تعديل '])

    </form>

</x-dashboard-layout>

<script>
    //for area and city
    async function getCities() {
        try {
            const response = await fetch(`{{route('cities')}}`)
            const data = await response.json()
            return data
        } catch (err) {
            console.log(err)
        }
    }
    var selectedValue = 1;
    $(document).ready(function() {

        var selectedValue = $('#areaSelect').val();

        // استدعاء الوظيفة عند تغيير القيمة في الـ select
        $('#areaSelect').change(function() {
            // الحصول على القيمة المختارة من الـ select

            selectedValue = $(this).val();
            const cities = getCities().then(da => {

                const selectedCities = da.filter(item => item.area_id == selectedValue)
                const selectElment = document.getElementById('citySelect')
                appendOptions(selectedCities, "citySelect")

            })
        })
    })


    //for service provider and career

    async function getCareer() {
        try {
            const response = await fetch(`{{route('career')}}`)
            const data = await response.json()
            return data
        } catch (err) {
            console.log(err)
        }
    }


    var selectedValue1 = 1;

    $(document).ready(function() {
        // استدعاء الوظيفة عند تغيير القيمة في الـ select
        $('#serviceProvider').change(function() {
            // الحصول على القيمة المختارة من الـ select
            selectedValue1 = $(this).val();
            const cities = getCareer().then(da => {
                const selectedCareer = da.filter(item => item.service_id == selectedValue1)
                const selectElment = document.getElementById('career')
                appendOptions(selectedCareer, "career")

            })
        })
    })



    function appendOptions(data, selectedId) {

        $(`#${selectedId}`).empty()
        data.map(item => {
            const option = document.createElement('option')
            option.value = item.id
            option.innerHTML = item.name;

            return (
                document.getElementById(selectedId).appendChild(option)
            )
        })
    }


    // $(document).ready(function() {
    //     var citySelected = $('#cityValue').val();
    //     var mySelect = document.getElementById('citySelect');
    //     console.log(mySelect)

    //     // console.log(document.querySelectorAll('mySelect option'));

    //     for (var i, j = 0; i = mySelect.options[j]; j++) {
    //         console.log(mySelect.options);

    //         if (i.value == citySelected) {
    //             mySelect.selectedIndex = j;
    //             break;
    //         }


    //     }
    // })
</script>