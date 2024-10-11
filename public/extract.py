import pdfplumber

with pdfplumber.open("30 June 2023.pdf") as pdf:
    # Extract text from the first page (you can loop over pages if needed)
    first_page = pdf.pages[0]
    text = first_page.extract_text()

    print(text)  # Print the text to inspect the format and structure