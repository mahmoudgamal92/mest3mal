



    <div class="main-section bg-main post-add-bg">
        <div class="container container-post-add">
            <form>

                <div class="custom-bg-pd mb-3 post-detail-wrap post-ads-content">
                    <h3 class="add-post-title">{{trans('orbscope.details')}} {{trans('front.ad')}}</h3>
                    <div class="post-detail-fields row">

                        <div class="form-group col-lg-6">
                            <p class="field-heading">عدد الغرف</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="1Bedroom">
                                    <label class="form-check-label" for="1Bedroom">
                                        1  غرفة نوم
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="4Bedroom">
                                    <label class="form-check-label" for="4Bedroom">
                                        4  غرفة نوم
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="2Bedroom">
                                    <label class="form-check-label" for="2Bedroom">
                                        2  غرفة نوم
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="5Bedroom">
                                    <label class="form-check-label" for="5Bedroom">
                                        5  غرفة نوم
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="3Bedroom">
                                    <label class="form-check-label" for="3Bedroom">
                                        3  غرفة نوم
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="bedrooms" id="6plusbed">
                                    <label class="form-check-label" for="6plusbed">
                                        6+  غرفة نوم
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- bedrooms /-->

                        <div class="form-group col-lg-6">
                            <p class="field-heading">مساحة السطح</p>
                            <div class="form-group categories-sort d-flex">
                                <input type="text" class="form-control" placeholder="" id="areavalue">
                                <select id="surface-araa" class="form-control">
                                    <option selected>متر مربع</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- surface area /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">أرضية</p>
                            <div class="form-group categories-sort">
                                <select id="Floor" class="form-control w-100">
                                    <option selected>أرضية</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Floor /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">عمر</p>
                            <div class="form-group categories-sort">
                                <select id="Floor" class="form-control w-100">
                                    <option selected>0 - 11 شهر</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Age /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">مفروشة، مد، زود</p>
                            <div class="form-group categories-sort">
                                <select id="Floor" class="form-control w-100">
                                    <option selected>مفروشة، مد، زود</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Furnished /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">عدد الحمامات</p>
                            <div class="row m-0">
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="airConditioning">
                                    <label class="form-check-label" for="airConditioning">
                                        تكيف
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Elevator">
                                    <label class="form-check-label" for="Elevator">
                                        مصعد
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Heating">
                                    <label class="form-check-label" for="Heating">
                                        تدفئة
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Garden">
                                    <label class="form-check-label" for="Garden">
                                        حديقة
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Balcony">
                                    <label class="form-check-label" for="Balcony">
                                        شرفة
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Garage/Parking">
                                    <label class="form-check-label" for="Garage/Parking">
                                        المرآب / وقوف السيارات
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Security">
                                    <label class="form-check-label" for="Security">
                                        الأمان
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Building">
                                    <label class="form-check-label" for="Building">
                                        بناء في خزائن
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Solar">
                                    <label class="form-check-label" for="Solar">
                                        الألواح الشمسية
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Doublepane">
                                    <label class="form-check-label" for="Doublepane">
                                        نوافذ مزدوجة اللوح
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Maid">
                                    <label class="form-check-label" for="Maid">
                                        غرفة الخادمة
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Facilities">
                                    <label class="form-check-label" for="Facilities">
                                        المرافق القريبة
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Laundry">
                                    <label class="form-check-label" for="Laundry">
                                        غرفة الغسيل
                                    </label>
                                </div>
                                <div class="form-check col-sm-6 col-12 custom-check">
                                    <input class="form-check-input" type="checkbox"  id="Swimming">
                                    <label class="form-check-label" for="Swimming">
                                        حمام السباحة
                                    </label>
                                </div>
                            </div>
                        </div> <!-- Amenities /-->
                        <div class="form-group col-lg-6">
                            <p class="field-heading">طريقة الدفع او السداد</p>
                            <div class="row m-0">
                                <div class="form-check col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="PaymentMethod" id="Cash">
                                    <label class="form-check-label" for="Cash">
                                        نقد فقط
                                    </label>
                                </div>
                                <div class="form-check col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="PaymentMethod" id="Installments">
                                    <label class="form-check-label" for="Installments">
                                        تقسيط فقط
                                    </label>
                                </div>
                                <div class="form-check col-12 custom-check">
                                    <input class="form-check-input" type="radio" name="PaymentMethod" id="Installment">
                                    <label class="form-check-label" for="Installment">
                                        نقدا أو تقسيط
                                    </label>
                                </div>
                            </div>
                        </div> <!-- Payment Method /-->
                        <div class="color-select form-group col-6">
                            <p class="field-heading">اللون</p>
                            <div class="d-flex flex-wrap m-0 color-label">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color1">
                                    <label class="form-check-label color-choose color1" for="color1">
                                        #6EB2FB;
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color2">
                                    <label class="form-check-label color-choose color2" for="color2">
                                        #3AD3CA
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color3">
                                    <label class="form-check-label color-choose  color3" for="color3">
                                        #F7495E
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color4">
                                    <label class="form-check-label color-choose  color4" for="color4">
                                        #FA5F3F
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color5">
                                    <label class="form-check-label color-choose color5" for="color5">
                                        #F9E738
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color6">
                                    <label class="form-check-label color-choose color6" for="color6">
                                        #7ED321
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="color7">
                                    <label class="form-check-label color-choose color7" for="color7">
                                        #977DFC
                                    </label>
                                </div>
                            </div>
                        </div> <!-- color /-->
                        <div class="form-group col-12 form-control-004">
                            <label for="AdTitle" class="field-heading">عنوان الاعلان</label>
                            <input type="text" class="form-control form-control-123" id="AdTitle" placeholder="اكتب العنوان هنا">
                        </div> <!-- title /-->
                        <div class="form-group col-12 form-control-004">
                            <label for="addescription" class="field-heading">وصف الإعلان</label>
                            <textarea class="form-control form-control-123" id="addescription" placeholder="اكتب الوصف هنا" rows="3"></textarea>
                        </div> <!-- title /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <label class="field-heading" for="price">السعر</label>
                            <div class="form-group categori d-flex">
                                <input type="text" class="form-control flex-grow-1" placeholder="" id="price">
                                <select id="priceoption" class="form-control">
                                    <option selected>دولار أمريكي</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Price /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label class="field-heading" for="price">بلد</label>
                                <select id="Country" class="form-control">
                                    <option selected>بلد</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-lg-4 form-group-123">
                            <div class="form-group categori">
                                <label class="field-heading" for="price">مدينة</label>
                                <select id="City" class="form-control">
                                    <option selected>جدة</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div> <!-- Country /-->
                        <div class="form-group col-12 ">
                            <div class="form-group categori ">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d475324.7392766921!2d38.93096525158295!3d21.44988977886947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2sJeddah%20Saudi%20Arabia!5e0!3m2!1sen!2s!4v1598259519729!5m2!1sen!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div> <!-- Country /-->
                    </div>
                </div> <!-- post detail section /-->
                <div class="custom-bg-pd mb-3 post-ads-content">
                    <h3 class="add-post-title">صورة المنتج</h3>
                    <div class="form-group-info">
                        <div class="avatar-upload">
                            <fieldset class="form-group">
                                <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
                            </fieldset>
                            <div class="preview-images-zone">
                                <a href="javascript:void(0)" onclick="$('#pro-image').click()" class="upload-image"><img src="img/signs%20-icon.png"></a>

                            </div>
                        </div>
                    </div>
                </div> <!-- prodcut image  /-->
                <div class="custom-bg-pd mb-3 post-ads-content">
                    <h3 class="add-post-title"><span><img src="img/Icon-stars.png" alt="img"></span> تمييز إعلانك</h3>
                    <div class="row justify-content-center">
                        <div class="col-md-4 account-price d-flex flex-column h-100 mr-5">
                            <h4 class="membership-heading text-center">عضوية ذهبية</h4>
                            <p class="mem-price text-center">$0.0</p>
                            <div class="mem-qty text-center d-flex">
                                <span class="minus bg-dark">-</span>
                                <div class="qty-wrap">
                                    <input type="number" class="count" name="qty" value="1" disabled="">
                                    <span>شهر</span>
                                </div>
                                <span class="plus bg-dark">+</span>
                            </div>
                            <ul class="mem-list">
                                <li>اكسب 100 نقطة عند اكتمال الملف الشخصي</li>
                                <li>مقدمة فيديو في صفحة الملف الشخصي</li>
                                <li>اعرض بريدك الإلكتروني ورقمك في صفحة الملف الشخصي</li>
                            </ul>
                            <button class="btn submit-btn uprade_btn_002 mt-auto">تطوير</button>
                        </div>
                        <div class="account-price col-md-4  d-flex flex-column h-100">
                            <h4 class="membership-heading text-center">العضوية الفضية</h4>
                            <p class="mem-price text-center">$0.0</p>
                            <div class="mem-qty text-center d-flex">
                                <span class="minus bg-dark">-</span>
                                <div class="qty-wrap">
                                    <input type="number" class="count" name="qty" value="1" disabled="">
                                    <span>شهر</span>
                                </div>
                                <span class="plus bg-dark">+</span>
                            </div>
                            <ul class="mem-list">
                                <li>اكسب 100 نقطة عند اكتمال الملف الشخصي</li>
                                <li>مقدمة فيديو في صفحة الملف الشخصي</li>
                                <li>اعرض بريدك الإلكتروني ورقمك في صفحة الملف الشخصي</li>
                            </ul>
                            <button class="btn submit-btn uprade_btn_002 mt-auto">تطوير</button>
                        </div>
                    </div>
                </div> <!-- Feature Your Ad  /-->
                <div class="custom-bg-pd mb-3 post-ads-content">
                    <h3 class="add-post-title"><span><img src="img/Icon-stars.png" alt="img"></span> معلومات للتواصل</h3>
                    <div class="row ml-1">
                        <div class="form-group col-lg-4 form-group-009">
                            <label for="fullname" class="field-heading">الاسم الكامل</label>
                            <input type="text" class="form-control" id="fullname" placeholder="عبدالرحمن">
                        </div>
                        <div class="form-group col-lg-4 form-group-009">
                            <label for="phone" class="field-heading">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone" placeholder="+911875148415">
                        </div>
                    </div>
                </div> <!--Contact Information /-->
                <div class="custom-bg-pd mb-3 text-center post-ads-content">
                    <h3 class="add-post-title">جاهز للنشر؟</h3>
                    <button type="submit" class="btn custom-btn published-by-ads">انشر إعلاني</button>
                </div> <!--publish /-->
            </form>
        </div>
    </div>

