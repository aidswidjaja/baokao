/* crappy fix for Primer's broken Box Overlay close button*/

const box_overlay = document.getElementById('upload-info-dialog');
const box_overlay_toggle = document.getElementById('upload-info-dialog-toggle');
const box_overlay_x = document.getElementById('upload-info-dialog-x');

box_overlay_x.addEventListener('click', () => {
    box_overlay.removeAttribute("open");
});