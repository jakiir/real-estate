function dropFiles(e){

}
//Handle html file input
function readFile(f,callback){
  if(!f || !f.type.match(/^image/ig)){
    return callback(null);
  }
  console.log(f);
  var fr = new FileReader();
  fr.readAsDataURL(f);
  fr.onloadend=function(){
    callback(fr.result);
  }
}
