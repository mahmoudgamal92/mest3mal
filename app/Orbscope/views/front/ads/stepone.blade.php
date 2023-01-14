@extends('front.layout.app')
@section('style')

@endsection
@section('content')



    <div class="main-section bg-main category-bg">
        <div class="container">



            <div class="row">
                <div class="col-12">

                    <div class="catgory_list">

                        <div class="col-lg-12">
                            <div class="cate_heading">
                                <h3>{{trans('front.What_do_advertise')}}</h3>
                                <h5 style="padding-bottom: 15px;">{{trans('front.chose_cat')}}</h5>
                            </div>
                        </div>

                        @foreach($departs as $depart)
                            <div class="media media-1">
                                <img src="{{ShowImage($depart->image)}}" class="align-self-start mr-3" alt="image">
                                <div class="media-body medai-body-1">
                                    <h5 class="mt-0"><a class="main_cat" id="{{$depart->id}}" href="#">{{VarByLang($depart->name,GetLanguage())}}</a></h5>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div><!-- end col -->
            </div><!-- end row -->


        </div>
    </div>

 @endsection
@section('js')


    <script>

        $(document).on('click', '.main_cat', function () {

            var main_cat = $(this).attr('id');
            $.ajax({
                url: '{{url('category/ajax')}}',
                dataType: 'html',
                type: 'post',
                data: {_token: '{{csrf_token()}}', main_cat: main_cat},
                beforeSend: function () {
                    //$('.city_data').removeClass('hidden');
                }, success: function (data) {
                    $('.catgory_list').html(data);
                   // $('select[name="cat_id"]').val("{{old('cat_id')}}").select2();
                }
            });
        });
    </script>

@endsection