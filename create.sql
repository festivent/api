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

create table "password_resets" (
  "email" varchar(255) not null,
  "token" varchar(255) not null,
  "created_at" timestamp(0) without time zone null
);

create index "password_resets_email_index" on "password_resets" ("email");

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
  foreign key ("parent_id") references "categories" ("id") on delete cascade on update cascade;

create table "organizers" (
  "id" serial primary key not null,
  "name" varchar(127) not null,
  "telephone" varchar(31) null,
  "email" varchar(127) null,
  "user_id" integer null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

create index "organizers_name_index" on "organizers" ("name");
alter table "organizers" add constraint "organizers_user_id_foreign"
  foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;

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

create index "counties_name_index" on "counties" ("name");
alter table "counties" add constraint "counties_province_id_foreign"
  foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;

create table "addresses" (
  "id" serial primary key not null,
  "name" varchar(127) not null,
  "address" text not null,
  "hint" text null,
  "province_id" integer not null,
  "county_id" integer not null
);

create index "addresses_name_index" on "addresses" ("name");
alter table "addresses" add constraint "addresses_province_id_foreign"
  foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;
alter table "addresses" add constraint "addresses_county_id_foreign"
  foreign key ("county_id") references "counties" ("id") on delete cascade on update cascade;

create table "events" (
  "id" serial primary key not null,
  "title" varchar(127) not null,
  "description" text null,
  "image" varchar(63) null,
  "started_at" timestamp(0) without time zone not null,
  "ended_at" timestamp(0) without time zone null,
  "price" decimal(5, 2) null,
  "price_type" varchar(7) not null default 'tl',
  "capacity" smallint null,
  "age_limit" smallint null,
  "user_id" integer null,
  "organizer_id" integer null,
  "address_id" integer not null,
  "created_at" timestamp(0) without time zone null,
  "updated_at" timestamp(0) without time zone null
);

create index "events_title_index" on "events" ("title");
create index "events_started_at_index" on "events" ("started_at");

alter table "events" add constraint "events_user_id_foreign"
  foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "events" add constraint "events_organizer_id_foreign"
  foreign key ("organizer_id") references "organizers" ("id") on delete cascade on update cascade;
alter table "events" add constraint "events_address_id_foreign"
  foreign key ("address_id") references "addresses" ("id") on delete cascade on update cascade;

create table "user_categories" (
  "user_id" integer not null,
  "category_id" integer not null
);

alter table "user_categories" add constraint "user_categories_user_id_category_id_unique"
  unique ("user_id", "category_id");
alter table "user_categories" add constraint "user_categories_user_id_foreign"
  foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "user_categories" add constraint "user_categories_category_id_foreign"
  foreign key ("category_id") references "categories" ("id") on delete cascade on update cascade;

create table "user_provinces" (
  "user_id" integer not null,
  "province_id" integer not null
);

alter table "user_provinces" add constraint "user_provinces_user_id_province_id_unique"
  unique ("user_id", "province_id");
alter table "user_provinces" add constraint "user_provinces_user_id_foreign"
  foreign key ("user_id") references "users" ("id") on delete cascade on update cascade;
alter table "user_provinces" add constraint "user_provinces_province_id_foreign"
  foreign key ("province_id") references "provinces" ("id") on delete cascade on update cascade;

create table "event_categories" (
  "event_id" integer not null,
  "category_id" integer not null
);

alter table "event_categories" add constraint "event_categories_event_id_category_id_unique"
  unique ("event_id", "category_id");
alter table "event_categories" add constraint "event_categories_event_id_foreign"
  foreign key ("event_id") references "events" ("id") on delete cascade on update cascade;
alter table "event_categories" add constraint "event_categories_category_id_foreign"
  foreign key ("category_id") references "categories" ("id") on delete cascade on update cascade;

