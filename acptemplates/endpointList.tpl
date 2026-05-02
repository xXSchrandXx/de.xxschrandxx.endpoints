{include file='header' pageTitle='wcf.acp.menu.link.devtools.endpointList'}

<header class="contentHeader">
    <div class="contentHeaderTitle">
        <h1 class="contentTitle">{lang}wcf.acp.menu.link.devtools.endpointList{/lang}</h1>
    </div>
</header>

{if $controllers|count}
    <div class="section tabularBox">
        <table class="table">
            <thead>
                <tr>
                    <th>{lang}wcf.global.title{/lang}</th>
                    <th>{lang}wcf.acp.sessionLog.requestMethod{/lang}</th>
                    <th>{lang}wcf.acp.page.url{/lang}</th>
                    <th>{lang}wcf.acp.devtools.project.path{/lang}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$controllers item=controller}
                    <tr>
                        <td class="columnTitle">{$controller['name']}</td>
                        <td class="columnText">{$controller['method']}</td>
                        <td class="columnText">{$controller['uri']}</td>
                        <td class="columnText">{$controller['namespace']}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{else}
    <p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

{include file='footer'}
