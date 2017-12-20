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