let nbclickColor = 0;
let nbclickCut = 0;

function showProductColor(id) {

    let classThProductColor = ".thProductColor" + id;
    let classProductColor = ".productColor" + id;
    // console.log(classThProductColor);

    let thProductColor = document.querySelector(classThProductColor);
    let productColor = document.querySelectorAll(classProductColor);
    console.log(productColor);
    // afficher le contenu
    if (nbclickColor % 2 == 0) {

        thProductColor.classList.remove("d-none");

        productColor.forEach(function(element) {
            element.classList.remove("d-none");
        });

    } else {
        thProductColor.classList.add("d-none");

        productColor.forEach(function(element) {
            element.classList.add("d-none");
        });
    }
    nbclickColor++;
}


function showProductCut(id) {

    let classThProductCut = ".ThProductCut" + id;
    let classProductCut = ".productCut" + id;

    let ThProductCut = document.querySelector(classThProductCut);
    let productCut = document.querySelectorAll(classProductCut);
    console.log(ThProductCut);
    console.log(productCut);
    if (nbclickCut % 2 == 0) {

        ThProductCut.classList.remove("d-none");
        productCut.forEach(function(element) {
            element.classList.remove("d-none");
        });

    } else {
        ThProductCut.classList.add("d-none");
        productCut.forEach(function(element) {
            element.classList.add("d-none");
        });
    }
    nbclickCut++;

}