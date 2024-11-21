import argparse
import pdfplumber
import sys

def extract_pdf_text(pdf_path, text_path):
    try:
        # Open the PDF file
        with pdfplumber.open(pdf_path) as pdf:
            extracted_text = ""
            for page in pdf.pages:
                extracted_text += page.extract_text() + "\n"

        # Write the extracted text to the output file
        with open(text_path, 'w', encoding='utf-8') as text_file:
            text_file.write(extracted_text)

        print(f"Text successfully extracted and saved to: {text_path}")
        sys.exit(0)  # Exit with status 0 (success)
    except Exception as e:
        print(f"Error: {e}")
        sys.exit(1)  # Exit with status 1 (error)

def main():
    # Set up argument parser
    parser = argparse.ArgumentParser(description="Extract text from a PDF file.")
    parser.add_argument("pdf_path", help="Path to the PDF file to extract text from.")
    parser.add_argument("text_path", help="Path to save the extracted text file.")
    
    # Parse arguments
    args = parser.parse_args()

    # Extract text from the PDF
    extract_pdf_text(args.pdf_path, args.text_path)

if __name__ == "__main__":
    main()