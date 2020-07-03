var collectInfos = document.getElementById("collectInfos");
var databaseType = document.getElementById("databaseType");
var databaseTypeChoose = document.getElementById("databaseTypeChoose");

for(var i = 0; i < 3; i++){
  if(i === 0) collectInfos.innerHTML = `${collectInfos.innerHTML}.`;
  if(i === 1) collectInfos.innerHTML = `${collectInfos.innerHTML}..`;
  if(i === 2){
    collectInfos.innerHTML = `${collectInfos.innerHTML}...`;
    i = 0;
  }
}

if(databaseType.selectedIndex !== 0) databaseTypeChoose.style = "display: none;"
