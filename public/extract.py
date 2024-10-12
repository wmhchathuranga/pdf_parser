import argparse
import pdfplumber

def extract_text_from_pdf(pdf_path, txt_output_path):
    with pdfplumber.open(pdf_path) as pdf:
        text = ""
        for page in pdf.pages:
            text += page.extract_text() + "\n"

    with open(txt_output_path, 'w') as f:
        f.write(text)

if __name__ == '__main__':
    
    parser = argparse.ArgumentParser(description="Extract text from a PDF file and write to a text file.")
    
    parser.add_argument('pdf_path', type=str, help="Path to the PDF file")
    parser.add_argument('txt_output_path', type=str, help="Path to the output text file")

    args = parser.parse_args()
    extract_text_from_pdf(args.pdf_path, args.txt_output_path)