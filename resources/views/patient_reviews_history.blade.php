@extends(backpack_view('blank'))

@push('before_styles')
    <style>
        @media print {
            .content-block {
                page-break-inside: avoid;
            }
        }

        @media print {
            #btn_print {
                display: none;
            }
        }
        @page {
            size:  auto;   /* auto is the initial value */
            margin: 17 17 17 17;  /* this affects the margin in the printer settings */
        }

    </style>
@endpush

@section('content')

    <div class="container" style="direction: rtl !important;">
        <br/>
            <a href="javascript: window.print();" id="btn_print" class="btn float-right"><i class="la la-print"></i></a>
            <h1 class="well" style="text-align: center">تاريخ مراجعات المريض</h1>
        <hr/>

        <div class="col-lg-12 well">
            @foreach ($reviews as $idx => $review)
                <div class="row content-block shadow-sm p-3 mb-5 bg-white rounded"  >
                    
                    <h3> بيانات المراجعة ( {{ date_format(date_create($review->date), "H:i ,d/m/Y") }} ) </h3>
                    <hr>
                    <div class="col-sm-12"  style="text-align: center">
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <br> <label> <b>اسم المريض :</b> {{ $patient->patient_name }}</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label>
                                    <b> الطول :</b> {{ $patient->patient_height }} سم
                                </label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> الوزن الحالي : </b> {{ $review->current_weight }} كغ </label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> الوزن المثالي : </b> {{ $review->perfect_weight }} كغ </label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> BMI : </b> {{ $patient->BMI }} </label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> نسبة الدهون : </b> {{ $review->fat_percentage }} %</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> نسبة السوائل : </b> {{ $review->fluid_ratio }} %</label>
                            </div>

                            <div class="col-sm-3 form-group">
                                <br> <label> <b> محيط العضد والمعصم : </b> {{ $review->circumference_of_the_upper_arm_and_wrist }}</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> محيط الخصر : </b> {{ $review->waistline }}</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> الورك : </b> {{ $review->hip }}</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> الصدر : </b> {{ $review->chest }}</label>
                            </div>
                            <div class="col-sm-3 form-group">
                                <br> <label> <b> الفخذ : </b> {{ $review->thigh }}</label>
                            </div>
                        </div>
                    </div>

                </div>
            
            @endforeach
        </div>
        <div id="pageFooter">Page </div>
    </div>

@endsection


                