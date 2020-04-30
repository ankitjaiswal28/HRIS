@extends('Layout.app')
@section('content')
<div class="main_card">
    <div class="neuphormic_shadow" style="padding:10px"><i class="fa fa-chevron-left" aria-hidden="true"
            style="font-size: 18px;margin-right: 20px;"></i><span class="bold_text" style="
        font-size: 18px;">Add Module<?php print_r($getDetails);?></span><i class="fa fa-close" aria-hidden="true"
            style="position: relative;float:right;top: 2px;font-size:20px"></i></div>
</div>
 <div class="container-fluid">
    <div class="row no_left_margin ">
    <?php
    $length = count($getDetails);
    for($j = 0; $j< $length; $j++){
        ?>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">{{$getDetails[$j]->moduleName}}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
    ?>
    {{--    <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 nopadding no_padding_left">
            <div class="second_card neuphormic_shadow" style="margin-bottom: 15px;padding: 10px 0px !important;">
                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <h5 style="font-weight: 600;margin-bottom: 0px;padding: 15px;">Abhishek</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox-animate ">
                            <label>
                                <input type="checkbox" name="check">
                                <span class="input-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
