<!-- default JS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--script type="text/javascript" language="javascript" src="<?php echo $baseurl ?>js/jquery-1.4.2.js"></script>-->




<!-- Checkbox JS -->
<script type="text/javascript" src="<?php echo $baseurl ?>js/custom-form-elements.js"></script>
<!-- Input WaterMark JS Start-->
<script type="text/javascript">
function watermark(inputId,text){
  var inputBox = document.getElementById(inputId);
    if (inputBox.value.length > 0){
      if (inputBox.value == text)
        inputBox.value = '';
    }
    else
      inputBox.value = text;
}
</script>
<!-- Input WaterMark JS End -->
<script type="text/javascript">
function unCheck(el, n){
el.form.elements[n].checked = false;
}
</script>
