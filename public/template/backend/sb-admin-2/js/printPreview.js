import jsPDF from "jspdf";
import html2canvas from "html2canvas";

export default {
    printPreview() {
        const printDocument = document.querySelector("#print-document");
        const filename = "print-preview.pdf";

        html2canvas(printDocument).then((canvas) => {
            const imgData = canvas.toDataURL("image/png");
            const pdf = new jsPDF("p", "mm", "a4");
            const width = pdf.internal.pageSize.getWidth();
            const height = pdf.internal.pageSize.getHeight();

            pdf.addImage(imgData, "PNG", 0, 0, width, height, "", "FAST");
            pdf.save(filename);
        });
    },
};
