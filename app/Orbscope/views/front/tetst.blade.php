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

            }
        });
    });
</script>

<script>

    $(document).on('click', '.second_cat', function () {

        var second_cat = $(this).attr('id');
        $.ajax({
            url: '{{url('sub_category/ajax')}}',
            dataType: 'html',
            type: 'post',
            data: {_token: '{{csrf_token()}}', second_cat: second_cat},
            beforeSend: function () {
                //$('.city_data').removeClass('hidden');
            }, success: function (data) {
                $('.catgory_list').html(data);
                // $('select[name="cat_id"]').val("{{old('cat_id')}}").select2();
            }
        });
    });
</script>


<div class="custom-bg-pd mb-3 post-ads-content">
    <h3 class="add-post-title">{{trans('orbscope.images')}}</h3>
    <div class="form-group-info">
        <div class="avatar-upload">
            <fieldset class="form-group">
                <input type="file"  id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
            </fieldset>
            <div class="preview-images-zone">
                <a href="javascript:void(0)" onclick="$('#pro-image').click()" class="upload-image"><img src="{{url('orbscope/front')}}/img/signs%20-icon.png"></a>

            </div>
        </div>
    </div>
</div> <!-- prodcut image  /-->