TRUNCATE TABLE samples;

INSERT INTO samples (id, text1, date1, number1, created, modified) VALUES
(1, 'abc', '2013-04-04', 11, '2013-04-04 01:02:03', '2013-04-04 23:59:59'),
(2, 'あいう', '2013-04-05', 22, '2013-04-05 00:00:00', '2013-04-05 00:00:00');
