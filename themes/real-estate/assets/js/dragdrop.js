function dragEnterHandler(){
  //console.log("drag enter");
  $(this).addClass('hassomething');
}
function dragLeaveHandler(){
  $(this).removeClass('hassomething');
  //console.log("drag Leave");
}
function allowDrop(e){
  e.preventDefault();
}
$('body').on('dragover','.droparea',allowDrop);
$('body').on('dragover','.imgdrop',allowDrop);
$('body').on('dragenter','.droparea',dragEnterHandler);
$('body').on('dragleave','.droparea',dragLeaveHandler);
