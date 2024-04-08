document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(
        ".datatable-search .datatable-input"
    );
    const tableRows = document.querySelectorAll(
        ".datatable-container table tbody tr"
    );

    searchInput.addEventListener("input", function () {
        const searchTerm = this.value.trim().toLowerCase();

        tableRows.forEach(function (row) {
            const cells = row.querySelectorAll("td");
            let rowContainsSearchTerm = false;

            cells.forEach(function (cell) {
                if (
                    cell.textContent.trim().toLowerCase().includes(searchTerm)
                ) {
                    rowContainsSearchTerm = true;
                }
            });

            if (rowContainsSearchTerm) {
                row.style.display = ""; // show row
            } else {
                row.style.display = "none"; // hide row
            }
        });
    });

    const table = document.querySelector(".datatable-container table");
    const headers = table.querySelectorAll("thead th");

    headers.forEach(function (header, index) {
        header.addEventListener("click", function () {
            const columnIdx = index;
            const isAscending = this.classList.contains("asc");

            // Remove sorting classes from all headers
            headers.forEach(function (header) {
                header.classList.remove("asc", "desc");
            });

            if (isAscending) {
                this.classList.remove("asc");
                this.classList.add("desc");
            } else {
                this.classList.remove("desc");
                this.classList.add("asc");
            }

            sortTable(table, columnIdx, !isAscending);
        });
    });

    function sortTable(table, column, ascending) {
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));

        rows.sort(function (rowA, rowB) {
            const cellA = rowA
                .querySelectorAll("td")
                [column].textContent.trim();
            const cellB = rowB
                .querySelectorAll("td")
                [column].textContent.trim();

            if (ascending) {
                return cellA.localeCompare(cellB);
            } else {
                return cellB.localeCompare(cellA);
            }
        });

        rows.forEach(function (row) {
            tbody.appendChild(row);
        });
    }

    // const table = document.querySelector('.datatable-container table');
    const selector = document.querySelector(".datatable-selector");
    const info = document.querySelector(".datatable-info");
    const pagination = document.querySelector(".datatable-pagination-list");

    let rowsPerPage = parseInt(selector.value);
    let currentPage = 1;

    // Initial display
    updateTableDisplay();

    selector.addEventListener("change", function () {
        rowsPerPage = parseInt(selector.value);
        currentPage = 1;
        updateTableDisplay();
    });

    pagination.addEventListener("click", function (event) {
        const target = event.target;

        if (target.tagName === "A") {
            const action = target.dataset.action;

            if (action === "prev" && currentPage > 1) {
                currentPage--;
            } else if (action === "next" && currentPage < totalPages()) {
                currentPage++;
            } else {
                const page = parseInt(target.dataset.page);
                if (!isNaN(page)) {
                    currentPage = page;
                }
            }

            updateTableDisplay();
        }
    });

    function updateTableDisplay() {
        const rows = table.querySelectorAll("tbody tr");

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        rows.forEach(function (row, index) {
            if (index >= startIndex && index < endIndex) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });

        updateInfo();
        updatePagination();
    }

    function updateInfo() {
        const totalRows = table.querySelectorAll("tbody tr").length;
        const start = (currentPage - 1) * rowsPerPage + 1;
        const end = Math.min(start + rowsPerPage - 1, totalRows);

        info.textContent = `عرض ${start} إلى ${end} من ${totalRows} عناصر`;
    }

    function updatePagination() {
        const total = totalPages();

        let paginationHTML = "";

        if (currentPage > 1) {
            paginationHTML += `<li class="datatable-pagination-list-item"><a data-action="prev" class="datatable-pagination-list-item-link">›</a></li>`;
        }

        for (let i = 1; i <= total; i++) {
            const activeClass = i === currentPage ? "datatable-active" : "";
            paginationHTML += `<li class="datatable-pagination-list-item ${activeClass}"><a data-page="${i}" class="datatable-pagination-list-item-link">${i}</a></li>`;
        }

        if (currentPage < total) {
            paginationHTML += `<li class="datatable-pagination-list-item"><a data-action="next" class="datatable-pagination-list-item-link">‹</a></li>`;
        }

        pagination.innerHTML = paginationHTML;
    }

    function totalPages() {
        const totalRows = table.querySelectorAll("tbody tr").length;
        return Math.ceil(totalRows / rowsPerPage);
    }
});
