<div id="delete-element-message-box-wrapper" class="message-box-wrapper" onclick="hideDeleteElementMessageBox()">
    <form id="delete-element-message-box" class="message-box" onclick="stopPropagate(event)" method="POST">
        <div class="icon-container">
            <i class="fas fa-check icon-correct"></i>
            <i class="fas fa-times icon-incorrect"></i>
            <i class="fas fa-exclamation icon-warning"></i>
        </div>
        <h2>Undefined</h2>
        <p>Undefined</p>
        <button type = "submit" onclick="hideDeleteElementMessageBox()">OK</button>
        <button onclick="hideDeleteElementMessageBox()">Hủy</button>
    </form>
</div>