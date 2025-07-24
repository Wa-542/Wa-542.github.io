--ต้องการภาค ประเทศ เมื่อง ชื่อบริษัทลูกค้า เบอร์
SELECT Region, Country, City, CompanyName, Phone
FROM Customers
order by 1 asc,2 asc,3 asc

--มูลค่าสินค้าคงเหลือต่อรายการ
SELECT ProductID, ProductName,
                 UnitPrice, UnitsInStock,
                 UnitPrice * UnitsInStock AS StockValue   
FROM Products

--ต้องสั่งสินค้าเพิ่มหรือยัง
SELECT ProductID as รหัส, ProductName as สืนค้า,
       UnitsInStock + UnitsOnOrder as จำนวนคงเหลือทั้งหมด,
       ReorderLevel as จุดสั่งซื้อ
FROM Products
where (UnitsInStock + UnitsOnOrder) < ReorderLevel

--ภาษีมูลค่าเพิ่ม7%
SELECT ProductID , ProductName ,
      UnitPrice, ROUND(UnitPrice * 0.07,2)AS Vat7
FROM Products

--ชื่อสกุลพนังงาน
SELECT employeeID, 
       TitleOfCourtesy + FirstName + SPACE(1) + LastName as [EmployeeName]
FROM Employees

--ต้องการทราบราคาในแต่ละรายการขายสินค้า
SELECT OrderID, ProductID, UnitPrice,Quantity,Discount,
       (UnitPrice * Quantity) - (UnitPrice * Quantity * Discount)
       as NetPrice
FROM [Order Details]
--หรือ
SELECT OrderID, ProductID, UnitPrice,Quantity,Discount,
       (UnitPrice * Quantity) * (1 - Discount)
       as NetPrice
FROM [Order Details]
--ราคาจริง = ราคาเต็ม - ส่วนลด
--ราคาเต็ม = ราคา * จำนวน
--ส่วนลด  = ราคาเต็ม + ลด
--ราคาจริง = (ราคา * จำนวน) - (ราคา * จำนวน * ลด)

SELECT (42.40*35)-(42.40*35*0.15)

--ต้องการทราบอายุ และอายุงานของพนังงานทุกคน จนถึงปัจจุบัน
SELECT employeeID, FirstName, BirthDate, Datediff(YEAR,BirthDate,GETDATE()) Age,
       HireDate, DATEDIFF(YEAR, HireDate,GETDATE()) YearInOffce
FROM Employees

SELECT GETDATE()

--แสดงข้อมูลจำนวนสินค้าที่มีเก็บไว้ต่ ากว่า 15 ชิ้น
SELECT COUNT(*)AS จำนวนสินค้า, 
FROM Products
WHERE UnitsInStock < 15

SELECT *
FROM  Products
WHERE UnitsInStock < 15

SELECT COUNT(*)AS จำนวนสินค้า, COUNT(ProductsID), COUNT(ProductsName), COUNT(UnitPrice)
FROM Products
WHERE UnitsInStock < 15

--จำนวนลูกค้าที่อยุ่ประเทศ USA
SELECT COUNT(*) from Customers where Country = 'USA'

--จำนวนพนักงานที่อยู่ใน London
SELECT COUNT(*) from Employees where City = 'London'

--จำนวนใบสั่งชื้อที่ออกในปี1997
SELECT COUNT(*) from Orders where YEAR(OrderDate) = 1997

--จำนวนครั้งที่ขายสินค้ารหัส1
SELECT COUNT(*) from [Order Details] where ProductID = 1

--function Sum
--จำนวนสินค้าที่ขายได้ทั้งหมด เฉพาะรหัสที่1
SELECT SUM(Quantity)
from [Order Details] 
where ProductID = 2

--มูลค่าสินค้าในคลังทั้งหมด
SELECT SUM(UnitPrice * UnitsInStock)
from Products 

--จำนวนสินค้ารหัสประเภท 8 ที่สั่งซื้อแล้ว
SELECT SUM(UnitsOnOrder)
from Products
where CategoryID = 8 

--function Max,Min
--ราคาสินค้ารหัส 1 ที่ขายได้ราคาสูงสุดและต่ำสุด
SELECT MAX(UnitPrice), MIN(UnitPrice)
from [Order Details] 
where ProductID = 71

--function AVG
--ราคาสินค้าเฉลี่ยทั้งหมดที่เคยขายได้ เแพาะสินค้ารหัส 5
SELECT AVG(UnitPrice), MAX(UnitPrice), MIN(UnitPrice)
from [Order Details] 
where ProductID = 5

--GROUP BY
--แสดงชื่อประเทศ และจำนวนลูกค้าที่อยู่ในแต่ละประเทศ จากตารางลูกค้า
SELECT Country , COUNT(*) as [Num of Country]
FROM Customers
GROUP BY Country

--รหัวประเภทสินค้า ราคาเฉลี่ยของสินค้าประเภทเดียวกัน
SELECT categoryID, AVG(UnitPrice), MAX(UnitPrice), MIN(UnitPrice)
FROM Products
GROUP BY categoryID

--ราคาสินค้าในใบสั่งซื้อทุกใบ[Order Details] 
SELECT count(*)
from [Order Details] 
GROUP BY orderID

--ต้องการประทศ และจำนวนใบสั่งซื้อที่ส่งสินค้าไปถึงปลายทาง
SELECT ShipCountry, COUNT(*)
from orders 
GROUP BY ShipCountry


--HAVING
--แสดงชื่อประเทศ และจำนวนลูกค้าที่อยู่ในแต่ละประเทศ จากตารางลูกค้า
--โดยแสดงเฉพาะประเทศที่มีลูกค้าต่ำกว่า 5 ราย
SELECT Country , COUNT(*) as "Num of Country"
FROM Customers
GROUP BY Country
HAVING COUNT(*) < 5

--ต้องการประทศ และจำนวนใบสั่งซื้อที่ส่งสินค้าไปถึงปลายทาง
--ต้องการเฉพาะที่มีจำนวนใบสั่งซื้อตั้งแต่100 ขึ้นไป
SELECT ShipCountry, COUNT(*) numOfOrders
from orders 
GROUP BY ShipCountry
HAVING COUNT(*) >= 100

--ราคาสินค้าในใบสั่งซื้อทุกใบ[Order Details]
--เฉพาะใบสั่งซื้อใบสั่งซื้อสินค้าที่ 3 ชนิด
SELECT count(*)
from [Order Details] 
GROUP BY orderID
HAVING COUNT(*) >3

--ข้อมูลรหัสใบสั่งซื้อ ยอดเงินรวมในใบสั่งซื้อนั้น แสดงฉพาะใบสั่งซื้อที่มียอดเงินน้อยกว่า100[Order Details]
SELECT OrderID, SUM(UnitPrice * Quantity * (1-Discount))
from [Order Details] 
GROUP BY orderID
HAVING SUM(UnitPrice * Quantity * (1-Discount)) < 100

--ประเทศใดที่มีจำนวนใบสั่งซื้อที่ส่งสินค้าไปปลายทางต่ำกว่า 20 รายการ ในปี1997
SELECT ShipCountry, COUNT(OrderID) as numOfrders
from  Orders
WHERE YEAR(OrderDate) =1997
GROUP BY ShipCountry
HAVING COUNT(*) < 20
ORDER BY COUNT(*) DESC

--ใบสังซื้อใดมียอดขายสูงที่สุด แสดงรหัสใบสั่งซื้อและยอดขาย
SELECT top 1 OrderID, SUM(UnitPrice * Quantity * (1-Discount)) as total
from [Order Details] 
GROUP BY orderID
ORDER BY total DESC

--ใบสังซื้อใดมียอดขายต่ำสุด 5 อันดับ แสดงรหัสใบสั่งซื้อและยอดขาย
SELECT top 5 OrderID, SUM(UnitPrice * Quantity * (1-Discount)) as total
from [Order Details] 
GROUP BY orderID
ORDER BY total ASC
