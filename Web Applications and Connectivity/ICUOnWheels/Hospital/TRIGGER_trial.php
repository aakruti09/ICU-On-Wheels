CREATE TRIGGER trying AFTER INSERT ON `details`
 FOR EACH ROW
 DECLARE
 BEGIN
  INSERT INTO trigger1.detailing(dname1) VALUES(:OLD.dname1)