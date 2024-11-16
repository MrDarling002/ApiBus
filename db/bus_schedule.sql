CREATE TABLE Bus (
    id SERIAL PRIMARY KEY,
    number VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL
);

CREATE TABLE Stop (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE Route (
    id SERIAL PRIMARY KEY,
    bus_id INT REFERENCES Bus(id),
    direction VARCHAR(255) NOT NULL
);

CREATE TABLE RouteStop (
    route_id INT REFERENCES Route(id),
    stop_id INT REFERENCES Stop(id),
    stop_order INT NOT NULL,
    PRIMARY KEY (route_id, stop_id)
);

CREATE TABLE Schedule (
    route_id INT REFERENCES Route(id),
    stop_id INT REFERENCES Stop(id),
    arrival_time TIME NOT NULL,
    PRIMARY KEY (route_id, stop_id, arrival_time)
);

-- Пример данных
INSERT INTO Bus (number, type) VALUES ('11', 'Автобус');
INSERT INTO Bus (number, type) VALUES ('21', 'Автобус');

INSERT INTO Stop (name) VALUES ('ул. Пушкина');
INSERT INTO Stop (name) VALUES ('ул. Ленина');
INSERT INTO Stop (name) VALUES ('ост. Попова');

INSERT INTO Route (bus_id, direction) VALUES (1, 'ост. Попова');
INSERT INTO Route (bus_id, direction) VALUES (2, 'ост. Ленина');

INSERT INTO RouteStop (route_id, stop_id, stop_order) VALUES (1, 1, 1);
INSERT INTO RouteStop (route_id, stop_id, stop_order) VALUES (1, 2, 2);
INSERT INTO RouteStop (route_id, stop_id, stop_order) VALUES (2, 1, 1);
INSERT INTO RouteStop (route_id, stop_id, stop_order) VALUES (2, 3, 2);

INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (1, 1, '08:15');
INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (1, 1, '08:40');
INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (1, 1, '09:15');
INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (2, 1, '08:30');
INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (2, 1, '09:04');
INSERT INTO Schedule (route_id, stop_id, arrival_time) VALUES (2, 1, '09:30');