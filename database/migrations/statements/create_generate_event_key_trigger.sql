CREATE TRIGGER generate_event_key_trigger BEFORE INSERT ON events
  FOR EACH ROW EXECUTE PROCEDURE generate_event_key();