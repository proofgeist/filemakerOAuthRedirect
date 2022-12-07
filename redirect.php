<?php
error_reporting(0);
​
    $code   = filter_input( INPUT_GET, 'code' );
    $error = filter_input( INPUT_GET, 'error' );
    $realm  = filter_input( INPUT_GET, 'realmId' );
    $state  = filter_input( INPUT_GET, 'state' );
    $json = json_encode( $_GET, $param );
​
​
    $stateParam  = json_decode ( base64_decode ( urldecode( $state ) ), true );
    $version = $stateParam['version'];
    $host = $stateParam['host'];
    $file = $stateParam['file'];
    $scriptToCall = $stateParam['script'];
​
    
    if($version > 17){
        $versionCleaned = "fmp" . $version;
    }else{
        $versionCleaned = "fmp";
    }
​
​
    if ( empty( $code ) && ( ! empty( $error ) ) ) {
        $color  = '#D32F2F';
        $param  = 'error|' . $error;
        $result = 'Error. There was an error while completing your request.';
    } else if ( empty( $host ) || empty( $scriptToCall ) ) {
        $color  = '#D32F2F';
        $result = 'Error. There was an error and we were unable to process the request.';
    } else {
        $url    = $versionCleaned . '://' . $host .'/' . $file . '?' . http_build_query( [ 'script' => $scriptToCall, 'param' => $json ] );
        $color  = '#2E7D32';
        $result = 'Success. Click open FileMaker to continue the authentication process.';
    }
​
?>
​
<!DOCTYPE html>
<html>
<head>
    <title>Proof+Geist oAuth Redirection</title>
<style>
​
body {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #ffffff;
}
.result {
    color: #ffffff;
    text-align: center;
    background-color: <?php echo $color ?> ; 
}
/* This parent can be any width and height */
.block {
  text-align: center;
​
  /* May want to do this if there is risk the container may be narrower than the element inside */
  white-space: nowrap;
}
 
/* The ghost, nudged to maintain perfect centering */
.block:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -0.25em; /* Adjusts for spacing */
}
​
/* The element to be centered, can also be of any width and height */ 
.centered {
  display: inline-block;
  vertical-align: middle;
  width: 800px;
  background-color: <?php echo $bgColor ?> ;
​
}
​
h2 {
  padding: 0px 10px 0px 10px;
}
​
.centered a img {
    display : block;
    margin : auto;
}
​
</style>
</head>
<body>
​
<div class="block" style="height: 350px;">
​
<div class="centered">
​
<svg viewBox="0 0 193 122" width="12.13rem" height="7.625rem"><defs><linearGradient x1="11.5417091%" y1="67.4250471%" x2="75.8513733%" y2="38.1993788%" id="linearGradient-1"><stop stop-color="#FF595E" offset="0%"></stop><stop stop-color="#89236B" offset="99.14%"></stop></linearGradient></defs><g id="logo-for-light" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="light-logo" fill-rule="nonzero"><g id="Group" fill="#950B6E"><g transform="translate(53.611111, 55.972527)"><path d="M34.3111111,45.0461538 C34.3111111,50.5093407 34.3111111,55.2351648 30.8263889,59.7598901 C27.6097222,63.8489011 22.6842014,65.7928571 17.5911458,65.7928571 C8.07517361,65.7928571 1.00520833,59.7598901 0.770659722,50.0736264 L6.60086806,50.0736264 C6.66788194,56.4082418 11.2583333,60.3967033 17.5241319,60.3967033 C26.5375,60.3967033 28.5144097,53.7604396 28.5144097,46.0516484 L28.5144097,41.9626374 L28.3803819,41.9626374 C25.5993056,45.5153846 21.109375,47.6269231 16.5189236,47.6269231 C6.56736111,47.6269231 0.234548611,39.2478022 0.234548611,29.7291209 C0.234548611,20.1098901 6.634375,11.5296703 16.7534722,11.5296703 C21.4779514,11.5296703 25.6328125,13.6412088 28.3803819,17.3615385 L28.5144097,17.3615385 L28.5144097,12.5016484 L34.3446181,12.5016484 L34.3446181,45.0461538 L34.3111111,45.0461538 Z M6.16527778,29.2598901 C6.16527778,35.9631868 10.0855903,42.2978022 17.3565972,42.2978022 C24.8621528,42.2978022 28.7824653,36.2648352 28.7824653,29.3269231 C28.7824653,22.4895604 24.4935764,16.9593407 17.2895833,16.9593407 C10.5211806,16.9593407 6.16527778,22.8582418 6.16527778,29.2598901 Z" id="Shape"></path><path d="M47.1107639,30.8686813 C47.1777778,37.2032967 51.7012153,42.2978022 58.3020833,42.2978022 C63.2611111,42.2978022 66.4442708,39.3148352 68.7227431,35.2258242 L73.6817708,38.0747253 C70.3980903,44.1747253 64.8694444,47.693956 57.9,47.693956 C47.7138889,47.693956 41.1800347,39.9181319 41.1800347,30.0642857 C41.1800347,19.9423077 47.0772569,11.5631868 57.7659722,11.5631868 C68.75625,11.5631868 74.5864583,20.6461538 73.9833333,30.8351648 L47.1107639,30.8351648 L47.1107639,30.8686813 Z M67.8515625,25.9082418 C67.0473958,20.9478022 62.8925347,16.9593407 57.7994792,16.9593407 C52.7734375,16.9593407 48.1159722,20.9478022 47.3788194,25.9082418 L67.8515625,25.9082418 Z" id="Shape"></path><polygon id="Path" points="87.453125 46.721978 81.6229167 46.721978 81.6229167 11.4291209 87.453125 11.4291209"></polygon><path d="M111.946701,20.4450549 C111.142535,18.6351648 109.400174,16.9593407 107.289236,16.9593407 C105.245313,16.9593407 103.067361,18.5681319 103.067361,20.7467033 C103.067361,23.8637363 106.987674,25.0368132 111.008507,26.7126374 C114.995833,28.3884615 118.949653,30.8016484 118.949653,36.532967 C118.949653,43.0016484 113.722569,47.6604396 107.389757,47.6604396 C101.626563,47.6604396 97.1366319,44.3758242 95.3272569,39.0131868 L100.487326,36.8346154 C101.928125,40.0521978 103.603472,42.2978022 107.456771,42.2978022 C110.572917,42.2978022 112.985417,40.1862637 112.985417,37.0692308 C112.985417,29.4274725 97.5722222,32.0417582 97.5722222,21.282967 C97.5722222,15.5181319 102.229688,11.5967033 107.758333,11.5967033 C111.678646,11.5967033 115.330903,14.3785714 116.838715,17.9313187 L111.946701,20.4450549 Z" id="Path"></path><polygon id="Path" points="133.290625 46.721978 127.460417 46.721978 127.460417 17.8978022 123.908681 17.8978022 123.908681 12.5016484 127.460417 12.5016484 127.460417 0.201098901 133.290625 0.201098901 133.290625 12.5016484 139.388889 12.5016484 139.388889 17.8978022 133.290625 17.8978022"></polygon></g><path d="M5.83020833,25.1708791 L5.96423611,25.1708791 C8.81232639,21.3835165 13.0342014,19.339011 17.7586806,19.339011 C27.8107639,19.339011 34.1435764,27.9862637 34.1435764,37.4714286 C34.1435764,47.2247253 27.9447917,55.4362637 17.6916667,55.4362637 C13.0342014,55.4362637 8.7453125,53.3917582 5.96423611,49.6714286 L5.83020833,49.6714286 L5.83020833,73.7362637 L0,73.7362637 L0,20.310989 L5.83020833,20.310989 L5.83020833,25.1708791 Z M5.52864583,37.0357143 C5.52864583,43.739011 9.44895833,50.0736264 16.7199653,50.0736264 C24.2255208,50.0736264 28.1458333,44.0406593 28.1458333,37.1027473 C28.1458333,30.2653846 23.8569444,24.7351648 16.6529514,24.7351648 C9.88454861,24.7351648 5.52864583,30.6340659 5.52864583,37.0357143 Z" id="Shape"></path><path d="M47.8144097,23.9978022 L47.9484375,23.9978022 C49.9923611,21.3164835 51.7347222,19.339011 55.5210069,19.339011 C57.4979167,19.339011 59.0727431,20.0093407 60.7480903,20.9478022 L57.9670139,26.2769231 C56.7942708,25.4725275 55.9901042,24.7351648 54.4822917,24.7351648 C48.0824653,24.7351648 47.7809028,32.9467033 47.7809028,37.4043956 L47.7809028,54.4978022 L41.9506944,54.4978022 L41.9506944,20.310989 L47.7809028,20.310989 L47.7809028,23.9978022 L47.8144097,23.9978022 Z" id="Path"></path><path d="M141.030729,54.4978022 L135.200521,54.4978022 L135.200521,25.6401099 L132.017361,25.6401099 L132.017361,20.243956 L135.234028,20.243956 L135.234028,13.4065934 C135.234028,10.5576923 135.234028,7.00494505 136.775347,4.52472527 C138.651736,1.47472527 142.102951,0.234615385 145.587674,0.234615385 C146.961458,0.234615385 148.36875,0.536263736 149.742535,0.971978022 L149.742535,6.87087912 C148.435764,6.43516484 147.263021,6.06648352 145.822222,6.06648352 C141.097743,6.06648352 141.097743,9.41813187 141.097743,15.4510989 L141.097743,20.2774725 L149.742535,20.2774725 L149.742535,25.6736264 L141.097743,25.6736264 L141.097743,54.4978022 L141.030729,54.4978022 Z" id="Path"></path></g><polygon id="Path" fill="#FF4757" points="45 88.3751187 30.3751187 88.3751187 30.3751187 103 24.5916429 103 24.5916429 88.3751187 10 88.3751187 10 82.5916429 24.5916429 82.5916429 24.5916429 68 30.3751187 68 30.3751187 82.5916429 45 82.5916429"></polygon><path d="M108.905392,19 C103.433367,19 98.1963377,21.3333218 94.8728383,25.6666338 C91.3479145,30.266611 91.3814852,32.7999319 90.8107833,37.0332443 C89.837233,43.9332102 85.3051882,48.5665207 79.0946083,48.5665207 C72.6490336,48.5665207 67.4120041,43.3665464 67.4120041,36.966578 C67.4120041,30.5666096 72.6490336,25.3666352 79.0946083,25.3666352 C82.1159715,25.3666352 85.4730417,26.4666298 87.9572737,29.466615 C88.7293998,27.3666254 89.8036623,25.3999684 91.1464903,23.6666436 C87.353001,20.4333263 83.1566633,19.0333332 79.0946083,19.0333332 C69.1241099,19.0333332 61,27.09996 61,36.9999111 C61,46.8998623 69.1241099,54.9664891 79.0946083,54.9664891 C84.3652085,54.9664891 89.5686673,52.4331683 93.1271617,48.3331885 C95.7456765,45.3332033 96.6520855,41.9665533 97.155646,37.8999067 C98.0620549,30.4332769 102.258393,25.4666347 108.938962,25.4333016 C115.384537,25.3999684 120.621567,30.6332759 120.621567,37.0332443 C120.621567,43.4332127 115.384537,48.633187 108.938962,48.633187 C105.917599,48.633187 102.5941,47.3998598 100.076297,44.5665404 C99.3041709,46.6331969 98.1963377,48.633187 96.8870804,50.3665118 C96.8870804,50.3665118 101.721261,55.0331554 108.905392,55 C118.87589,54.9331559 127,46.9331954 127,37.0332443 C126.966429,27.0666268 118.87589,19 108.905392,19 Z" id="Path" fill="url(#linearGradient-1)"></path></g></g></svg>
​
<h2 class="result"><?php echo $result ?></h2>
​
<!--- </div> --->
         
</div>
​
    <script>
    
            var url = "<?php echo $url; ?>";
            console.log(url);
            
            if(url === ""){
            
            // Do Nothing
            console.log(url);
            
            }else{
                
            // Redirection
            console.log(url);
            console.log("attempt redirection");
            window.location = "<?php echo $url; ?>"; 
                
            };
            
        
    </script>
​
</body>
​
</html>
