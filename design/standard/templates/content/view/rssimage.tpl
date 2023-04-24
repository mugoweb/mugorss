{*
   INPUT 
      image_alias    : image alias string
*}

{if is_unset( $image_alias )}
	{def $image_alias = 'medium'}
{/if}

{def $alias = $object.data_map.image.content.$image_alias}
<media:content height="{$alias.height}" type="{$alias.mime_type}" width="{$alias.width}" url="{$alias.full_path|ezroot( 'no', 'full' )}">
	<media:credit scheme="urn:ebu">{$object.data_map.credit.content|wash()}</media:credit>
	<media:description>{$object.data_map.caption.content|wash()}</media:description>
</media:content>
