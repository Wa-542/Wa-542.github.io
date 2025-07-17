SELECT * FROM Employees

SELECT EmployeeID , FirstName , LastName FROM Employees

SELECT * FROM Employees WHERE City = 'London'

SELECT City, Country FROM Customers

SELECT DISTINCT City, Country FROM Customers

SELECT * FROM Products WHERE Unitprice > 200

SELECT * FROM Customers WHERE City = 'London' OR City = 'Vancouver'

SELECT * FROM Customers WHERE Country = 'USA' OR City = 'Vancouver'

--แสดงข้อมูลสินค้าที่มีจำนวนคงเหลือต่ำกว่า 20 
--หรือ มีจำนวนคงเหลือน้อยกว่าระดับการสั่งซื้อ

SELECT * FROM Products WHERE UnitPrice >= 50 or UnitsInStock < 20

--แสดงข้อมูลสินค้าที่มีราคาตั้งแต่ 50-100 $
SELECT * FROM Products WHERE UnitPrice BETWEEN 50 AND 100
SELECT *FROM Products WHERE UnitPrice >= 50 AND UnitPrice<=100

--•แสดงข้อมูลลูกค้าที่อยู่ในประเทศ Brazil, Argentina, Mexico
SELECT * FROM Customers WHERE Country IN ('Brazil','Argentina','Mexico');
SELECT * FROM Customers WHERE Country = 'Brazil' or Country = 'Argentina' or Country = 'Mexico'

--แสดงข้อมูลพนักงานมีชื่อขึ้นต้นด้วยตัวอักษร N
SELECT * FROM Employees WHERE FirstName LIKE 'N%'
--ข้อมูลลูกค้าที่ขึ้นต้นด้วย A
SELECT * FROM Customers WHERE CompanyName LIKE 'A%'
--ข้อมูลลูกค้าที่ด้วย Y
SELECT * FROM Customers WHERE CompanyName LIKE '%Y'

--ต้องการชื่อ-สกุล พนังงานที่มีชื่อประกอบด้วยตัว 'an'
SELECT firstname, lastname FROM Employees WHERE FirstName LIKE '%an%'

--แสดงข้อมูลพนักงานที่มีชื่อประกอบด้วยตัวอักษร 5 ตัว
SELECT * FROM Employees WHERE FirstName LIKE '_ _ _ _ _'

--แสดงข้อมูลรหัสสินค้า, ชื่อสินค้า และราคาโดยเรียงลำดับผลลัพธ์จากราคาสูงที่สุดไปต่ำที่สุด
SELECT ProductID,ProductName,UnitPrice FROM Products ORDER BY UnitPrice DESC
--แสดงข้อมูลชื่อบริษัทที่เป็นลูกค้า และชื่อผู้ติดต่อ โดยเรียงลำดับชื่อผู้ติดต่อตามลๆดับตัวอักษร
SELECT CompanyName, ContactName FROM Customers ORDER BY ContactName ASC

--ต้องการชื่อ ราคาสิ่งค่า จำนวนคงเหลือ ที่มีจำนวนคงเหลือสูงที่สุด 10 อันดับแรก
SELECT top 10 ProductName, UnitPrice, UnitsInStock 
FROM Products ORDER BY UnitsInStock DESC

--แสดงข้อมูลรหัสประเภทสินค้า, ชื่อสินค้า และราคา โดยเรียงลeดับ
--ตามรหัสประเภทสินค้าจากน้อยไปมาก หากรหัสประเภทเป็นรหัส
--เดียวกันให้เรียงตามราคาสินค้าจากมากไปน้อย
SELECT CategoryID, ProductName, UnitPrice 
FROM Products ORDER BY CategoryID ASC , UnitPrice DESC

