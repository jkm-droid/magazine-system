    <section>
        <div class="container"  style="margin-to: 40px;">
            <div class="card pdf-container border-0" id="pdf-container">
                <div class="top-bar text-center">
                    <nav aria-label="Page navigation example">
                        <a class="put-black text-center" href="#">
                            <span class="page-info"><span id="page-num"></span><span id="page-count"></span></span>
                        </a>
                    </nav>
                </div>

                <span class="text-center float-right" id="load" style="margin-top: 20%;">Loading Publication...Please wait</span>
                <div class="text-center align-items-center pdf-canvas">
                    <div class="prev-next">
                        <a class="previous display-3" id="prev-page" href="#"><i class="bx bx-chevron-left"></i></a>
                        <a class="next display-3" id="next-page" href="#"> <i class="bx bx-chevron-right"></i></a>
                    </div>

                    @for($i = 0; $i <= 224; $i++)
                    <canvas class="pdf-render" id="pdf-render{{ $i }}"></canvas>
                    @endfor

                    <style>
                        .hide{
                            display: none;
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/pdfjs/build/pdf.js') }}"></script>
    <script>
        const url = '{{ asset('magazine_split/p') }}';
        pdfjsLib.GlobalWorkerOptions.workerSrc = '{{ asset('js/pdfjs/build/pdf.worker.js') }}'

        let pdfDoc = null,
            pageNum = 1,
            numPages = 224,
            pageIsRendering = false,
            pageNumIsPending = null;

        const loaded = [];

        const scale = 1.5;

        const renderPage = num => {
            pageIsRendering = true;
            document.querySelector('#load').style.display = 'none';

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
            for(var i = num; i <= numPages && i < num+8; i++){
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
                document.querySelector('#page-count').textContent = '-'+numPages;
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

    </script>