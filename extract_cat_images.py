import pymupdf, os

pdf_path = r'C:\Users\Abhay\Desktop\AV_Global_Exports_Brass_Marble_Catalogue.pdf'
doc = pymupdf.open(pdf_path)

out_dir = r'C:\Users\Abhay\Desktop\av-global\assets\img\catalogue_extracted'
os.makedirs(out_dir, exist_ok=True)

print(f"Total pages: {len(doc)}")
for i, page in enumerate(doc):
    images = page.get_images(full=True)
    for img_idx, img in enumerate(images):
        xref = img[0]
        base_image = doc.extract_image(xref)
        image_bytes = base_image["image"]
        image_ext = base_image["ext"]
        out_name = f"page_{i+1:02d}_img_{img_idx+1}_{xref}.{image_ext}"
        out_file = os.path.join(out_dir, out_name)
        with open(out_file, "wb") as f:
            f.write(image_bytes)
        print(f"Page {i+1} Extracted: {out_name} ({base_image['width']}x{base_image['height']})")
