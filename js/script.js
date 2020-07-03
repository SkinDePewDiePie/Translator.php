var collectInfos = document.getElementById("collectInfos");
var databaseTypeSelected = document.getElementById("databaseTypeSelected");

for(var i = 0; i < 3; i++){
  if(i === 0) collectInfos.innerHTML = `${collectInfos.innerHTML}.`;
  if(i === 1) collectInfos.innerHTML = `${collectInfos.innerHTML}..`;
  if(i === 2){
    collectInfos.innerHTML = `${collectInfos.innerHTML}...`;
    i = 0;
  }
}

