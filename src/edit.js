import { TextControl } from "@wordpress/components";
import { useBlockProps } from "@wordpress/block-editor";
import { useState, useEffect } from "@wordpress/element";

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
	  {data && data.length > 0 && data.map(event => <p>{event.summary}</p>)}
	</div>
  );
}
