@extends('layouts.app')

@section('content')
<style>
    img {
        vertical-align: middle;
      }
      .cardLogo {
        padding: 2px;
        /* border: 1px solid #c3c3c3; */
        margin-right: 10px;
        float: left;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
           <div class="panel panel-default">
              <div class="panel-heading">Nạp thẻ cào</div>
              <div class="tab-container">
                 <ul class="nav nav-tabs">
                    <li class="active"><a href="#nap_the" data-toggle="tab"><span class="icon mdi mdi-home"></span>Nạp thẻ cào</a></li>
                    <li><a href="#nap_bang_anh" data-toggle="tab"><span class="icon mdi mdi-face"></span>Nạp bằng ảnh</a></li>
                 </ul>
                 <div class="tab-content">
                    <div id="nap_the" class="tab-pane active cont">
                       <div class="row">
                          <div class="col-sm-6">
                             <div class="panel panel-default panel-table">
                                <div class="panel-body">
                                   <table class="table table_napthe">
                                      <tbody>
                                         <tr>
                                            <td>Loại thẻ</td>
                                            <td>
                                               <div class="cardLogo"><input type="radio" class="radio_item" name="item" id="1" value="vtt"><label class="label_item" for="1"> <img src="https://doithe.pro/assets/img/logo/viettel.png"> </label></div>
                                               <div class="cardLogo"><input type="radio" class="radio_item" name="item" id="2" value="vnp"><label class="label_item" for="2"> <img src="https://doithe.pro/assets/img/logo/vinaphone.png"> </label></div>
                                               <div class="cardLogo"><input type="radio" class="radio_item" name="item" id="5" value="zing"><label class="label_item" for="5"> <img src="https://doithe.pro/assets/img/logo/Zing.png"> </label></div>
                                               <div class="cardLogo"><input type="radio" class="radio_item" name="item" id="6" value="vms"><label class="label_item" for="6"> <img src="https://doithe.pro/assets/img/logo/mobifone.png"> </label></div>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td>Mã Pin</td>
                                            <td><input type="text" class="form-control input-sm"></td>
                                         </tr>
                                         <tr>
                                            <td>Mã Serial</td>
                                            <td><input type="text" class="form-control input-sm"></td>
                                         </tr>
                                         <tr>
                                            <td>Mệnh giá</td>
                                            <td>
                                               <select class="form-control input-sm select2">
                                                  <option value="0">-- Chọn mệnh giá thẻ --</option>
                                                  <option value="10000">10.000&nbsp;₫</option>
                                                  <option value="20000">20.000&nbsp;₫</option>
                                                  <option value="30000">30.000&nbsp;₫</option>
                                                  <option value="50000">50.000&nbsp;₫</option>
                                                  <option value="100000">100.000&nbsp;₫</option>
                                                  <option value="200000">200.000&nbsp;₫</option>
                                                  <option value="300000">300.000&nbsp;₫</option>
                                                  <option value="500000">500.000&nbsp;₫</option>
                                                  <option value="1000000">1.000.000&nbsp;₫</option>
                                               </select>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td></td>
                                            <td><button type="button" class="btn btn-primary">Nạp thẻ</button></td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </div>
                             </div>
                          </div>
                          <div class="col-sm-6">
                             <div class="panel panel-default panel-table">
                                <div class="panel-heading">Phí đổi thẻ</div>
                                <div class="panel-body">
                                   <table class="table table-striped table-borderless">
                                      <thead>
                                         <tr>
                                            <th>TT</th>
                                            <th>Nhà mạng</th>
                                            <th class="number">Phí</th>
                                            <th class="number">Trạng thái</th>
                                         </tr>
                                      </thead>
                                      <tbody class="no-border-x">
                                         <tr>
                                            <td>1</td>
                                            <td>Viettel</td>
                                            <td class="number">36%</td>
                                            <td class="number"><span class="label label-success">Hoạt động</span></td>
                                         </tr>
                                         <tr>
                                            <td>2</td>
                                            <td>Vinaphone</td>
                                            <td class="number">39%</td>
                                            <td class="number"><span class="label label-success">Hoạt động</span></td>
                                         </tr>
                                         <tr>
                                            <td>3</td>
                                            <td>Vietnamobile</td>
                                            <td class="number">14%</td>
                                            <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                         </tr>
                                         <tr>
                                            <td>4</td>
                                            <td>Gate</td>
                                            <td class="number">13%</td>
                                            <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                         </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>Zing</td>
                                            <td class="number">39%</td>
                                            <td class="number"><span class="label label-success">Hoạt động</span></td>
                                         </tr>
                                         <tr>
                                            <td>6</td>
                                            <td>Mobifone</td>
                                            <td class="number">45%</td>
                                            <td class="number"><span class="label label-success">Hoạt động</span></td>
                                         </tr>
                                         <tr>
                                            <td>7</td>
                                            <td>Garena</td>
                                            <td class="number">14%</td>
                                            <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                         </tr>
                                         <tr>
                                            <td>8</td>
                                            <td>Vcoin</td>
                                            <td class="number">14%</td>
                                            <td class="number"><span class="label label-warning">Bảo trì</span></td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div id="nap_bang_anh" class="tab-pane cont">
                       <div class="row">
                          <div class="col-sm-6">
                             <table class="table table_napthe">
                                <tbody>
                                   <tr>
                                      <td>Loại thẻ</td>
                                      <td>
                                         <div class="cardLogo"><input type="radio" class="radio_item" name="item_anhchup" id="1_img" value="vtt"><label class="label_item" for="1_img"> <img src="https://doithe.pro/assets/img/logo/viettel.png"> </label></div>
                                         <div class="cardLogo"><input type="radio" class="radio_item" name="item_anhchup" id="2_img" value="vnp"><label class="label_item" for="2_img"> <img src="https://doithe.pro/assets/img/logo/vinaphone.png"> </label></div>
                                         <div class="cardLogo"><input type="radio" class="radio_item" name="item_anhchup" id="5_img" value="zing"><label class="label_item" for="5_img"> <img src="https://doithe.pro/assets/img/logo/Zing.png"> </label></div>
                                         <div class="cardLogo"><input type="radio" class="radio_item" name="item_anhchup" id="6_img" value="vms"><label class="label_item" for="6_img"> <img src="https://doithe.pro/assets/img/logo/mobifone.png"> </label></div>
                                      </td>
                                   </tr>
                                   <tr>
                                      <td>Ảnh chụp</td>
                                      <td><label for="file-upload" class="custom-file-upload">Chọn ảnh thẻ cào</label><input id="file-upload" type="file" class="form-control input-sm" accept="image/*"></td>
                                   </tr>
                                   <tr>
                                      <td>Mệnh giá</td>
                                      <td>
                                         <select class="form-control input-sm select2">
                                            <option value="0">-- Chọn mệnh giá thẻ --</option>
                                            <option value="10000">10.000&nbsp;₫</option>
                                            <option value="20000">20.000&nbsp;₫</option>
                                            <option value="30000">30.000&nbsp;₫</option>
                                            <option value="50000">50.000&nbsp;₫</option>
                                            <option value="100000">100.000&nbsp;₫</option>
                                            <option value="200000">200.000&nbsp;₫</option>
                                            <option value="300000">300.000&nbsp;₫</option>
                                            <option value="500000">500.000&nbsp;₫</option>
                                            <option value="1000000">1.000.000&nbsp;₫</option>
                                         </select>
                                      </td>
                                   </tr>
                                   <tr>
                                      <td colspan="2">Vui lòng cào lớp bạc và chụp đầy đủ ảnh bao gồm <strong>số Seri</strong> và <strong>mã thẻ</strong> như hình bên.</td>
                                   </tr>
                                   <tr>
                                      <td></td>
                                      <td><button type="button" class="btn btn-primary">Nạp thẻ</button></td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                          <div class="col-sm-6"><img id="the_preview" src="https://doithe.pro/assets/img/card_placeholder.jpg" style="width: 100%;"></div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="col-sm-4">
           <div class="panel panel-default">
              <div class="panel-heading">Mua thẻ cào</div>
              <div class="tab-container">
                 <ul class="nav nav-tabs">
                    <li class="active"><a href="#mua_the_cao" data-toggle="tab"><span class="icon mdi mdi-home"></span>Mua thẻ cào</a></li>
                    <li><a href="#mua_the_game" data-toggle="tab"><span class="icon mdi mdi-face"></span>Mua thẻ game</a></li>
                 </ul>
                 <div class="tab-content">
                    <div id="mua_the_cao" class="tab-pane active cont">
                       <table class="table table_napthe" style="margin-bottom: 20px;">
                          <tbody>
                             <tr>
                                <td>Loại thẻ</td>
                                <td>
                                  <select class="select" name="" id="">
                                        <option value="">Viettel</option>
                                  </select>
                                </td>
                             </tr>
                             <tr>
                                <td>Mệnh giá</td>
                                <td>
                                   <select class="form-control input-sm select2">
                                      <option value="10000">10.000&nbsp;₫</option>
                                      <option value="20000">20.000&nbsp;₫</option>
                                      <option value="30000">30.000&nbsp;₫</option>
                                      <option value="50000">50.000&nbsp;₫</option>
                                      <option value="100000">100.000&nbsp;₫</option>
                                      <option value="200000">200.000&nbsp;₫</option>
                                      <option value="300000">300.000&nbsp;₫</option>
                                      <option value="500000">500.000&nbsp;₫</option>
                                      <option value="1000000">1.000.000&nbsp;₫</option>
                                   </select>
                                </td>
                             </tr>
                             <tr>
                                <td>Số lượng</td>
                                <td><button class="btn btn-primary disabled"> - </button><span style="padding: 10px;">1</span><button class="btn btn-primary"> + </button></td>
                             </tr>
                             <tr>
                                <td>Thành tiền</td>
                                <td><input type="text" class="form-control input-sm" disabled="" value="10.000&nbsp;₫"></td>
                             </tr>
                             <tr>
                                <td></td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                    <div id="mua_the_game" class="tab-pane cont">Mua thẻ game</div>
                 </div>
              </div>
           </div>
        </div>
     </div>
</div>
@endsection
