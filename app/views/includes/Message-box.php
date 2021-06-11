
<div id="main-message-box-wrapper" class="message-box-wrapper" onclick="hideMessageBox()">
    <div id= "main-message-box" class="message-box" onclick="stopPropagate(event)">
        <div class="icon-container">
            <i class="fas fa-check icon-correct"></i>
            <i class="fas fa-times icon-incorrect"></i>
            <i class="fas fa-exclamation icon-warning"></i>
        </div>
        <h2>Thành công</h2>
        <p>message </p>
        <button onclick="hideMessageBox()">OK</button>
    </div>
</div>