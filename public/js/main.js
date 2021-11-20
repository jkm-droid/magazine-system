const url = ' http://127.0.0.1:8000/magazine_split/p';

let pdfDoc = null,
    pageNum = 1,
    numPages = 224,
    pageIsRendering = false,
    pageNumIsPending = null;

const loaded = [];

const scale = 1.5;

const renderPage = num => {
    pageIsRendering = true;

    console.log("Page num: "+num);

    pdfDoc.getPage(1).then(page => {
        const canvas = document.querySelector('#pdf-render'+num),
            ctx = canvas.getContext('2d');
        const viewport = page.getViewport({ scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
            canvasContext: ctx,
            viewport
        };

        page.render(renderCtx).promise.then(() => {
            pageIsRendering = false;

            if (pageNumIsPending !== null){
                console.log("pending: "+pageNumIsPending);
                renderPage(pageNumIsPending);
                pageNumIsPending = null;
            }
        });
    });
};

const displayOne = num => {
    $(".pdf-render").addClass("hide");
    $("#pdf-render"+num).removeClass("hide");
    document.querySelector('#page-num').textContent = num;

    var load = [num];
    for(var i = num; i > 0 && i > num-3; i--){
        console.log("loop: "+i);
        load.push(i);}
    for(var i = num; i <= numPages && i < num+4; i++){
        console.log("loop: "+i);
        load.push(i);}
    load.forEach(val => {if(!loaded.includes(val)){
        loadPdf(val);
        loaded.push(val);
        console.log(loaded);
    }});
}

// Check for pages rendering
// const queueRenderPage = num => {
//   if (pageIsRendering) {
//     pageNumIsPending = num;
//   } else {
//     renderPage(num);
//   }
// };

// Show Prev Page
const showPrevPage = () => {
    if (pageNum <= 1) {
        return;
    }
    pageNum--;
    console.log("prev: "+pageNum);
    displayOne(pageNum);
};

// Show Next Page
const showNextPage = () => {
    if (pageNum >= numPages) {
        return;
    }
    pageNum++;
    console.log("next: "+pageNum);
    displayOne(pageNum);
};

const loadPdf = function(number){
    pdfjsLib
        .getDocument(url+number+".pdf")
        .promise.then(pdfDoc_ => {
        pdfDoc = pdfDoc_;

        // document.querySelector('#page-count').textContent = pdfDoc.numPages;
        document.querySelector('#page-count').textContent = numPages;
        console.log("Load")
        renderPage(number);
    })
        .catch(err => {
            // Display error
            const div = document.createElement('div');
            div.className = 'error';
            div.appendChild(document.createTextNode(err.message));
            document.querySelector('body').insertBefore(div, canvas);
            // Remove top bar
            document.querySelector('.top-bar').style.display = 'none';
        });
}
displayOne(1);

document.querySelector('#prev-page').addEventListener('click', showPrevPage);
document.querySelector('#next-page').addEventListener('click', showNextPage);
