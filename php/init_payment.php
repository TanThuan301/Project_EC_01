<?php
 include("../connect_db/connection_db.php");
session_start();
?>
<?php
header('Content-type: text/html; charset=utf-8');

$config = file_get_contents('config.json');
$array = json_decode($config, true);

include "common/helper.php";


$endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


$partnerCode = $array["partnerCode"];
$accessKey = $array["accessKey"];
$secretKey = $array["secretKey"];
$orderInfo = "Thanh toán qua MoMo";
$amount = $_SESSION['tongtien'];
$orderId = time() ."";
$returnUrl = "http://localhost:8000/paymomo/result.php";
$notifyurl = "http://localhost:8000/paymomo/ipn_momo.php";
// Lưu ý: link notifyUrl không phải là dạng localhost
$extraData = "merchantName=Tan Thuan SGU";


if (!empty($_POST)) {
    $partnerCode = $_POST["partnerCode"];
    $accessKey = $_POST["accessKey"];
    $serectkey = $_POST["secretKey"];
    $orderId = $_POST["orderId"]; // Mã đơn hàng
    // var_dump($orderId);exit;
    $orderInfo = $_POST["orderInfo"];
    $amount = $_POST["amount"];
    $notifyurl = $_POST["notifyUrl"];
    $returnUrl = $_POST["returnUrl"];
    $extraData = $_POST["extraData"];

    $requestId = time() . "";
    $requestType = "captureMoMoWallet";
    $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'returnUrl' => $returnUrl,
        'notifyUrl' => $notifyurl,
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there
        // var_dump($jsonResult['payUrl']);
         header('Location:'.$jsonResult['payUrl']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoMo Sandbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
    <!-- CSS -->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center; font-size:2rem" >Khởi tạo thanh toán bằng MOMO</h3>
                </div>
                <div class="panel-body">
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="init_payment.php">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Mã thanh toán</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="partnerCode" value="<?php echo $partnerCode; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Mã hóa đơn</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderId" value="<?php echo $_SESSION['magiaodich']; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Thông tin thanh toán</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderInfo" value="<?php echo $orderInfo; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Khóa truy cập</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="accessKey" value="<?php echo $accessKey;?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Dữ liệu thanh toán</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' type="text" name="extraData" value="<?php echo $extraData?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Khóa bảo mật</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="secretKey" value="<?php echo $secretKey; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Tổng tiền</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="amount" value="<?php echo $amount; ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">URL</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="notifyUrl" value="<?php echo $notifyurl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">URL</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="returnUrl" value="<?php echo $returnUrl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>
                        <div style="margin-top: 1em;">
                            <button type="submit" class="btn btn-primary btn-block">Bấm tiếp tục để thanh toán....</button>
                        </div>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
<script type="text/javascript" src="./statics/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="./statics/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

</body>
</html>
