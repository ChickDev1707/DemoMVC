

<style>

    #rc-info-panel {
        position: absolute;
        border: 1px solid black;
        top: 50%;
        left: 50%;
        padding: 40px 20px;
        transform: translate(-50%, -50%);
    }

</style>
<div id= "rc-info-panel">
    <p>name: <?php echo $data->HO_TEN_DOC_GIA?></p>
    <p>type <?php echo $data->LOAI_DOC_GIA?></p>
    <p>date of birth <?php echo $data->NGAY_SINH?></p>
    <p>address <?php echo $data->DIA_CHI?></p>
    <p>email <?php echo $data->EMAIL?></p>
    <p>created date <?php echo $data->NGAY_LAP_THE?></p>
</div>