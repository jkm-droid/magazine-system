@extends('base.premium_index')

@section('content')
    <section>
        <div class="container"  style="margin-top: 40px;">
            <div class="card card-danger">
                <div class="card-header text-center">
                    <h4>{{ $magazine->title }} , {{ $magazine->issue }} Issue</h4>
                </div>
                <div class="top-bar">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#" id="prev-page">Previous</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <span class="page-info">Page <span id="page-num"></span> of <span id="page-count"></span></span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#" id="next-page">Next</a></li>
                        </ul>
                    </nav>

                </div>

                <canvas id="pdf-render"></canvas>
                <div class="top-bar text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#" id="prev-page">Previous</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <span class="page-info">Page <span id="page-num"></span> of <span id="page-count"></span></span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#" id="next-page">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        var copy = "{{ $magazine->copy }}";
        const url = '{{ asset('magazine_copies') }}/'+copy;

        let pdfDoc = null,
            pageNum = 4,
            pageIsRendering = false,
            pageNumIsPending = null;

        const scale = 1.5,
            canvas = document.querySelector('#pdf-render'),
            ctx = canvas.getContext('2d');

        // Render the page
        const renderPage = num => {
            pageIsRendering = true;

            // Get page
            pdfDoc.getPage(num).then(page => {
                // Set scale
                const viewport = page.getViewport({ scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderCtx = {
                    canvasContext: ctx,
                    viewport
                };

                page.render(renderCtx).promise.then(() => {
                    pageIsRendering = false;

                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }
                });

                // Output current page
                document.querySelector('#page-num').textContent = num;
            });
        };

        // Check for pages rendering
        const queueRenderPage = num => {
            if (pageIsRendering) {
                pageNumIsPending = num;
            } else {
                renderPage(num);
            }
        };

        // Show Prev Page
        const showPrevPage = () => {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        };

        // Show Next Page
        const showNextPage = () => {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        };

        // Get Document
        pdfjsLib
            .getDocument(url)
            .promise.then(pdfDoc_ => {
            pdfDoc = pdfDoc_;

            document.querySelector('#page-count').textContent = pdfDoc.numPages;

            renderPage(pageNum);
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

        // Button Events
        document.querySelector('#prev-page').addEventListener('click', showPrevPage);
        document.querySelector('#next-page').addEventListener('click', showNextPage);

    </script>
@endsection
