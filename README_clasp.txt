📄 วิธีใช้ CLASP เพื่อเชื่อม Google Apps Script

1. ติดตั้ง CLASP (ครั้งแรก)
   npm install -g @google/clasp

2. ล็อกอิน Google Account
   clasp login

3. โฟลเดอร์นี้มี scriptId แล้ว: 
   1y2DrJEFoRgkIdZlpzZgyt1mLXK6HBnkbr3qYDbje_MHicLZuWYdbceSp

4. ใช้คำสั่งต่อไปนี้เพื่ออัปโหลดโค้ดทั้งหมด:

   cd <project_folder>
   clasp push

5. เปิดหน้า Google Script Editor:
   clasp open

หมายเหตุ: ไฟล์โค้ดทั้งหมดอยู่ใน ./gsheet/gas-modules/
