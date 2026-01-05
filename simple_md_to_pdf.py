"""
Direct Markdown to PDF converter using FPDF2
"""
import re
from fpdf import FPDF

class PDF(FPDF):
    def __init__(self):
        super().__init__()
        self.set_auto_page_break(auto=True, margin=15)
        
    def header(self):
        pass
    
    def footer(self):
        self.set_y(-15)
        self.set_font('Arial', 'I', 8)
        self.set_text_color(128, 128, 128)
        self.cell(0, 10, f'Page {self.page_no()}', 0, 0, 'C')

def parse_markdown_line(line):
    """Parse markdown formatting from a line"""
    # Remove emojis and special characters
    line = re.sub(r'[🎯📝🖼️📄🎨💡⚠️🆘📞]', '', line)
    # Replace special Unicode characters
    line = line.replace('→', '->')
    line = line.replace('•', '*')
    line = line.replace('"', '"').replace('"', '"')
    line = line.replace(''', "'").replace(''', "'")
    line = line.replace('—', '-').replace('–', '-')
    return line.strip()

def convert_md_to_pdf(md_file, pdf_file):
    """Convert markdown to PDF"""
    
    # Read markdown
    with open(md_file, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remove last line (GitHub URL)
    lines = content.split('\n')
    if lines and lines[-1].startswith('http'):
        lines = lines[:-1]
    
    # Create PDF
    pdf = PDF()
    pdf.add_page()
    pdf.set_font('Arial', '', 10)
    
    # Colors
    BLUE = (52, 152, 219)
    DARK_BLUE = (44, 62, 80)
    GRAY = (127, 140, 141)
    LIGHT_GRAY = (149, 165, 166)
    
    i = 0
    in_code_block = False
    in_table = False
    table_data = []
    
    while i < len(lines):
        line = lines[i]
        
        # Code block
        if line.strip().startswith('```'):
            if not in_code_block:
                in_code_block = True
                pdf.ln(2)
            else:
                in_code_block = False
                pdf.ln(2)
            i += 1
            continue
        
        if in_code_block:
            pdf.set_font('Courier', '', 9)
            pdf.set_fill_color(244, 244, 244)
            text = parse_markdown_line(line)
            pdf.multi_cell(0, 5, text, 0, fill=True)
            pdf.set_font('Arial', '', 10)
            i += 1
            continue
        
        # Table detection
        if '|' in line and line.strip():
            if not in_table:
                in_table = True
                table_data = []
                pdf.ln(2)
            
            # Skip separator lines
            if re.match(r'^[\|\-\s:]+$', line):
                i += 1
                continue
            
            # Parse table row
            cells = [cell.strip() for cell in line.split('|')]
            cells = [c for c in cells if c]
            table_data.append(cells)
            i += 1
            continue
        elif in_table:
            # Render table
            if table_data:
                # Calculate column widths
                num_cols = len(table_data[0])
                col_width = (pdf.w - 40) / num_cols
                
                # Header row
                pdf.set_font('Arial', 'B', 9)
                pdf.set_fill_color(*BLUE)
                pdf.set_text_color(255, 255, 255)
                for cell in table_data[0]:
                    text = parse_markdown_line(cell).replace('**', '')
                    pdf.cell(col_width, 8, text[:30], 1, 0, 'L', True)
                pdf.ln()
                
                # Data rows
                pdf.set_font('Arial', '', 9)
                pdf.set_fill_color(249, 249, 249)
                pdf.set_text_color(0, 0, 0)
                for row in table_data[1:]:
                    for cell in row:
                        text = parse_markdown_line(cell).replace('**', '')
                        pdf.cell(col_width, 7, text[:30], 1, 0, 'L', True)
                    pdf.ln()
                
                pdf.ln(3)
            in_table = False
            table_data = []
        
        # Title (H1)
        if line.startswith('# '):
            text = parse_markdown_line(line[2:])
            pdf.set_font('Arial', 'B', 20)
            pdf.set_text_color(*DARK_BLUE)
            pdf.ln(5)
            pdf.multi_cell(0, 10, text)
            pdf.ln(5)
            pdf.set_text_color(0, 0, 0)
            pdf.set_font('Arial', '', 10)
        
        # H2
        elif line.startswith('## '):
            text = parse_markdown_line(line[3:])
            pdf.ln(8)
            pdf.set_font('Arial', 'B', 16)
            pdf.set_text_color(*DARK_BLUE)
            pdf.multi_cell(0, 8, text)
            pdf.set_draw_color(*LIGHT_GRAY)
            pdf.line(pdf.l_margin, pdf.get_y(), pdf.w - pdf.r_margin, pdf.get_y())
            pdf.ln(4)
            pdf.set_text_color(0, 0, 0)
            pdf.set_font('Arial', '', 10)
        
        # H3
        elif line.startswith('### '):
            text = parse_markdown_line(line[4:])
            pdf.ln(5)
            pdf.set_font('Arial', 'B', 13)
            pdf.set_text_color(*GRAY)
            pdf.multi_cell(0, 7, text)
            pdf.ln(2)
            pdf.set_text_color(0, 0, 0)
            pdf.set_font('Arial', '', 10)
        
        # H4
        elif line.startswith('#### '):
            text = parse_markdown_line(line[5:])
            pdf.ln(4)
            pdf.set_font('Arial', 'B', 11)
            pdf.set_text_color(*GRAY)
            pdf.multi_cell(0, 6, text)
            pdf.ln(1)
            pdf.set_text_color(0, 0, 0)
            pdf.set_font('Arial', '', 10)
        
        # Horizontal rule
        elif line.strip() == '---':
            pdf.ln(5)
            pdf.set_draw_color(*LIGHT_GRAY)
            pdf.line(pdf.l_margin, pdf.get_y(), pdf.w - pdf.r_margin, pdf.get_y())
            pdf.ln(5)
        
        # Bullet list
        elif line.strip().startswith('- ') or line.strip().startswith('* '):
            text = parse_markdown_line(line.strip()[2:])
            # Handle bold
            if '**' in text:
                parts = text.split('**')
                x_start = pdf.get_x() + 5
                pdf.set_x(x_start)
                pdf.write(5, '  - ')
                for idx, part in enumerate(parts):
                    if idx % 2 == 1:  # Bold part
                        pdf.set_font('Arial', 'B', 10)
                        pdf.write(5, part)
                        pdf.set_font('Arial', '', 10)
                    else:
                        # Remove code backticks
                        part = part.replace('`', '')
                        pdf.write(5, part)
                pdf.ln()
            else:
                text = text.replace('`', '')
                pdf.set_x(pdf.l_margin + 5)
                pdf.multi_cell(0, 5, f'  - {text}')
        
        # Numbered list
        elif re.match(r'^\d+\.\s', line.strip()):
            match = re.match(r'^(\d+)\.\s(.+)', line.strip())
            if match:
                number = match.group(1)
                text = parse_markdown_line(match.group(2)).replace('**', '').replace('`', '')
                pdf.set_x(pdf.l_margin + 5)
                pdf.multi_cell(0, 5, f'  {number}. {text}')
        
        # Regular paragraph
        elif line.strip() and not line.strip().startswith('http'):
            text = parse_markdown_line(line)
            # Handle bold
            if '**' in text:
                parts = text.split('**')
                for idx, part in enumerate(parts):
                    if idx % 2 == 1:
                        pdf.set_font('Arial', 'B', 10)
                        pdf.write(5, part)
                        pdf.set_font('Arial', '', 10)
                    else:
                        part = part.replace('`', '')
                        pdf.write(5, part)
                pdf.ln()
            else:
                text = text.replace('`', '')
                if text:
                    pdf.multi_cell(0, 5, text)
        
        # Empty line
        else:
            pdf.ln(2)
        
        i += 1
    
    # Save PDF
    pdf.output(pdf_file)
    print(f"✓ PDF created successfully: {pdf_file}")

def main():
    md_file = r'wp-theme\QUICK-REFERENCE.md'
    pdf_file = r'wp-theme\QUICK-REFERENCE.pdf'
    
    try:
        convert_md_to_pdf(md_file, pdf_file)
        print(f"\n✓ Conversion complete!")
        print(f"  Input:  {md_file}")
        print(f"  Output: {pdf_file}")
    except Exception as e:
        print(f"✗ Error: {e}")
        import traceback
        traceback.print_exc()

if __name__ == '__main__':
    main()
