<script type="text/ecmascript-6">
export default {
    methods: {
        recipientsCount(entry){
            return _.union((entry.content.to ? Object.keys(entry.content.to) : []),
                    (entry.content.cc ? Object.keys(entry.content.cc) : []),
                    (entry.content.bcc ? Object.keys(entry.content.bcc) : []),
                    (entry.content.replyTo ? Object.keys(entry.content.replyTo) : [])).length;
        }
    }
}
</script>

<template>
    <index-screen title="Mail" resource="mail">
        <tr slot="table-header">
            <th scope="col">Mailable</th>
            <th scope="col" class="text-right">Recipients</th>
            <th scope="col">Happened</th>
            <th scope="col"></th>
        </tr>

        <template slot="row" slot-scope="slotProps">
            <td>
                <span :title="slotProps.entry.content.mailable">{{
                    truncate(slotProps.entry.content.mailable || '-', 70)
                }}</span>

                <span class="badge badge-secondary ml-2" v-if="slotProps.entry.content.queued"> Queued </span>

                <br />

                <small class="text-muted" :title="slotProps.entry.content.subject">
                    Subject: {{ truncate(slotProps.entry.content.subject, 90) }}
                </small>
            </td>

            <td class="table-fit text-right text-muted">
                {{ recipientsCount(slotProps.entry) }}
            </td>

            <td
                class="table-fit text-muted"
                :data-timeago="slotProps.entry.created_at"
                :title="slotProps.entry.created_at"
            >
                {{ timeAgo(slotProps.entry.created_at) }}
            </td>

            <td class="table-fit">
                <router-link
                    :to="{
                        name: 'mail-preview',
                        params: { id: slotProps.entry.id },
                    }"
                    class="control-action"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM6.75 9.25a.75.75 0 000 1.5h4.59l-2.1 1.95a.75.75 0 001.02 1.1l3.5-3.25a.75.75 0 000-1.1l-3.5-3.25a.75.75 0 10-1.02 1.1l2.1 1.95H6.75z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </router-link>
            </td>
        </template>
    </index-screen>
</template>
