import { TextControl } from "@wordpress/components";
import { useBlockProps } from "@wordpress/block-editor";
import { useState, useEffect } from "@wordpress/element";
import moment from 'moment';

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps();
  const [data, setData] = useState({});

  useEffect(() => {
    fetch("http://lutz-wp.local/wp-json/icsProcessor/v1/events")
      .then((response) => response.json())
      .then((data) => setData(data))
      .catch((error) => console.error(error));
  }, []);

  console.log(data);

  return (
    <div {...blockProps}>
      <TextControl
        value={attributes.message}
        onChange={(val) => setAttributes({ message: val })}
      />
      {data && data.length > 0 &&
        <ul>
          {data.map((event, index) => {
            const startDate = moment(event.dtstart, 'YYYYMMDDTHHmmss').format('MMMM D, YYYY, h:mm A');
            const endDate = moment(event.dtend, 'YYYYMMDDTHHmmss').format('MMMM D, YYYY, h:mm A');
            return (
              <li key={index}>
                <h3>{event.summary}</h3>
                <p><em>Start Time: {startDate}</em></p>
                <p><em>End Time: {endDate}</em></p>
                {event.description && event.description.length > 0 &&
                  <p>{event.description}</p>
                }
              </li>
            );
          })}
        </ul>
      }
    </div>
  );
}
