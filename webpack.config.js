const path = require("path");
const fs = require("fs");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const viewsDir = path.resolve(__dirname, "resources/views");

const generateHTMLPlugins = () => {
    const files = fs.readdirSync(viewsDir);
    return files.map((file) => {
        return new HtmlWebpackPlugin({
            filename: file, // اسم الملف الناتج سيكون نفس اسم الملف الأصلي
            template: path.join(viewsDir, file), // مسار الملف القالب
            inject: true,
        });
    });
};

module.exports = {
    mode: "development",
    entry: "./public/assets/js/index.js",
    devServer: {
        static: {
            directory: path.join(__dirname, "public/assets"),
        },
        compress: true,
        port: 3000,
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ["style-loader", "css-loader"],
            },

            // معالج ملفات SVG
            {
                test: /\.svg$/,
                use: ["svg-url-loader"],
            },
        ],
    },
    plugins: [
        ...generateHTMLPlugins(),
        new MiniCssExtractPlugin({
            filename: "./resources/css/app.css",
        }),
    ],
    output: {
        path: path.resolve(__dirname, "public"),
        publicPath: "/",
        filename: "asset/js/[name].js",
        clean: true,
    },
};
