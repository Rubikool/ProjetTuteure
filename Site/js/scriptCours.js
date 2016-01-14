window.onload=function()
{
    AjouterPartition();
}


function AjouterPartition(id)
{
    var conteneurImage = document.getElementById(id);

    var imageADuppliquer = conteneurImage.src;

    var conteneur = document.getElementById("PartitionJS");

    var monImg = document.createElement('img');


    monImg.setAttribute("src" , imageADuppliquer);

    monImg.setAttribute("onclick" , "SupprimerPartition(\'id\')");

    conteneur.appendChild(monImg);

}
