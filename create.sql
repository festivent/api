create table "users" (
  "id" serial primary key not null,
  "name" varchar(127) not null,
  "email" varchar(127) not null,
  "password" varchar(255) not null,
  "gender" varchar(7) not null,
  "birth_at" date not null,
  "remember_token" varchar(100) null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

alter table "users" add constraint "users_email_unique" unique ("email");

create table "categories" (
  "id" serial primary key not null,
  "parent_id" integer null,
  "name" varchar(63) not null,
  "icon" varchar(31) not null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

create index "categories_name_index" on "categories" ("name");
alter table "categories" add constraint "categories_parent_id_foreign"
foreign key ("parent_id") references"categories" ("id") on delete cascade on update cascade;

create table "organizers" (
  "id" serial primary key not null,
  "name" varchar(127) not null,
  "telephone" varchar(31) null,
  "email" varchar(127) null,
  "user_id" integer null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

alter table "organizers" add constraint "organizers_user_id_foreign"
foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
create index "organizers_name_index" on "organizers" ("name");


create table "provinces" (
  "id" serial primary key not null,
  "name" varchar(127) not null
);

create index "provinces_name_index" on "provinces" ("name");

create table "counties" (
  "id" serial primary key not null,
  "province_id" integer not null,
  "name" varchar(127) not null
);

alter table "counties" add constraint "counties_province_id_foreign"
foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;
create index "counties_name_index" on "counties" ("name");

create table "addresses" (
  "id" serial primary key not null,
  "name" varchar(127) not null,
  "address" text not null,
  "hint" text null,
  "province_id" integer not null,
  "county_id" integer not null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

alter table "addresses" add constraint "addresses_province_id_foreign"
foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;
alter table "addresses" add constraint "addresses_county_id_foreign"
foreign key ("county_id") references "counties" ("id") on delete cascade on update cascade;
create index "addresses_name_index" on "addresses" ("name");

create table "events" (
  "id" serial primary key not null,
  "key" varchar(31) null,
  "title" varchar(127) not null,
  "description" text null,
  "image" varchar(63) null,
  "started_at" timestamp(0) without time zone not null,
  "ended_at" timestamp(0) without time zone null,
  "price" decimal(5, 2) null,
  "price_type" varchar(7) null default 'tl',
  "capacity" smallint null,
  "age_limit" smallint null,
  "user_id" integer null,
  "organizer_id" integer null,
  "address_id" integer not null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

alter table "events" add constraint "events_user_id_foreign"
foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "events" add constraint "events_organizer_id_foreign"
foreign key ("organizer_id") references "organizers" ("id") on delete cascade on update cascade;
alter table "events" add constraint "events_address_id_foreign"
foreign key ("address_id") references "addresses" ("id") on delete cascade on update cascade;
alter table "events" add constraint "events_key_unique" unique ("key");
create index "events_title_index" on "events" ("title");
create index "events_started_at_index" on "events" ("started_at");

create table "user_categories" (
  "user_id" integer not null,
  "category_id" integer not null
);

alter table "user_categories" add constraint "user_categories_user_id_category_id_unique" unique ("user_id", "category_id");
alter table "user_categories" add constraint "user_categories_user_id_foreign"
foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "user_categories" add constraint "user_categories_category_id_foreign"
foreign key ("category_id") references "categories" ("id") on delete cascade on update cascade;

create table "user_provinces" (
  "user_id" integer not null,
  "province_id" integer not null
);

alter table "user_provinces" add constraint "user_provinces_user_id_province_id_unique" unique ("user_id", "province_id");
alter table "user_provinces" add constraint "user_provinces_user_id_foreign"
foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "user_provinces" add constraint "user_provinces_province_id_foreign"
foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;

create table "event_categories" (
  "event_id" integer not null,
  "category_id" integer not null
);

alter table "event_categories" add constraint "event_categories_event_id_category_id_unique" unique ("event_id", "category_id");
alter table "event_categories" add constraint "event_categories_event_id_foreign"
foreign key ("event_id") references "events" ("id") on delete cascade on update cascade;
alter table "event_categories" add constraint "event_categories_category_id_foreign"
foreign key ("category_id") references "categories" ("id") on delete cascade on update cascade;

-- Trigger
CREATE OR REPLACE FUNCTION generate_event_key() RETURNS trigger
LANGUAGE plpgsql AS
$$
DECLARE
  CHARS VARCHAR(62) := '0123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
  BASE INTEGER := 62;
  tempId INTEGER;
  result VARCHAR(31);
  r DOUBLE PRECISION;
  q DOUBLE PRECISION;
  tempFrom INTEGER;
  tempQ INTEGER;
BEGIN
  -- Calculate the key if the key is null
  IF NEW.key ISNULL THEN
    -- If the key is not exists.
    tempId := NEW.id;

    r := tempId % BASE;
    q := floor(tempId / BASE);
    tempFrom := floor(r) + 1;
    result := substr(CHARS, tempFrom, 1);

    -- For debug
    RAISE NOTICE '(start) r -> %', r;
    RAISE NOTICE '(start) q -> %', q;
    RAISE NOTICE '(start) tempFrom -> %', tempFrom;
    RAISE NOTICE '(start) result -> %', result;


    WHILE q LOOP
      tempQ = floor(q);
      r := tempQ % BASE;
      q := floor(q / BASE);
      tempFrom := floor(r) + 1;
      result := concat(substr(CHARS, tempFrom, 1), result);

      -- For debug
      RAISE NOTICE '(loop) tempQ -> %', tempQ;
      RAISE NOTICE '(loop) r -> %', r;
      RAISE NOTICE '(loop) q -> %', q;
      RAISE NOTICE '(loop) tempFrom -> %', tempFrom;
      RAISE NOTICE '(loop) result -> %', result;
    END LOOP;

    -- For debug
    RAISE NOTICE '(FINAL) result -> %', result;
    NEW.key := result;
  END IF;

  RETURN NEW;
END;
$$;

-- Stored procedure
CREATE TRIGGER generate_event_key_trigger BEFORE INSERT ON events
  FOR EACH ROW EXECUTE PROCEDURE generate_event_key();

create or replace function get_user_events(input_user_id int)
  returns setof events as  $BODY$
declare item events;
begin
  for item in select events.* from events
    inner join event_categories on event_categories.event_id = events.id
    inner join addresses on addresses.id = events.address_id
  where event_categories.category_id in (select category_id from user_categories where user_id = input_user_id) and
        addresses.province_id in (select province_id from user_provinces where user_id = input_user_id)
  order by events.started_at desc
  LOOP
    return next item;
  end LOOP;
end;
$BODY$
LANGUAGE plpgsql;